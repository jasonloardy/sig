<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_penjualan extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('isLogin') == FALSE) {
      redirect('/');
    } else {
      $this->load->model('data_penjualan_model');
    }
  }

	public function index()
	{
    $data = array(
      'title' => 'Data Penjualan'
    );
    $this->load->view('pages/data_penjualan', $data);
	}

  public function json_all()
  {
    $from = str_replace("/", "-", $_GET['from']);
    $to = str_replace("/", "-", $_GET['to']);

    $jual = $this->data_penjualan_model->all_penjualan($from, $to);

    $response = array();

    foreach ($jual as $j) {
      $j['detail'] = array();

      $jualDetail = $this->data_penjualan_model->penjualan_detail($j['kd_invoice']);

      $sub_total = 0;

      foreach ($jualDetail as $jd) {
        array_push($j['detail'], $jd);
        $sub_total += $jd['jumlah'];
      }

      $jumlah_diskon = $sub_total * $j['diskon']/100;
      $ppn_10_persen = ($sub_total - $jumlah_diskon) * 10/100;
      $total_faktur = $sub_total - $jumlah_diskon + $ppn_10_persen;

      $j['sub_total'] = $sub_total;
      $j['jumlah_diskon'] = $jumlah_diskon;
      $j['ppn_10_persen'] = $ppn_10_persen;
      $j['total_faktur'] = intval($total_faktur);

      array_push($response, $j);
    }

    echo json_encode($response);
  }

  public function import()
  {
    error_reporting(0);
    if (isset($_POST['submit'])) {

      function xmlToArray($xml, $options = array())
      {
          $defaults = array(
              'namespaceSeparator' => ':',//you may want this to be something other than a colon
              'attributePrefix' => '@',   //to distinguish between attributes and nodes with the same name
              'alwaysArray' => array(),   //array of xml tag names which should always become arrays
              'autoArray' => true,        //only create arrays for tags which appear more than once
              'textContent' => '$',       //key used for the text content of elements
              'autoText' => true,         //skip textContent key if node has no attributes or child nodes
              'keySearch' => false,       //optional search and replace on tag and attribute names
              'keyReplace' => false       //replace values for above search values (as passed to str_replace())
          );
          $options = array_merge($defaults, $options);
          $namespaces = $xml->getDocNamespaces();
          $namespaces[''] = null; //add base (empty) namespace

          //get attributes from all namespaces
          $attributesArray = array();
          foreach ($namespaces as $prefix => $namespace) {
              foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                  //replace characters in attribute name
                  if ($options['keySearch']) $attributeName =
                          str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                  $attributeKey = $options['attributePrefix']
                          . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                          . $attributeName;
                  $attributesArray[$attributeKey] = (string)$attribute;
              }
          }

          //get child nodes from all namespaces
          $tagsArray = array();
          foreach ($namespaces as $prefix => $namespace) {
              foreach ($xml->children($namespace) as $childXml) {
                  //recurse into child nodes
                  $childArray = xmlToArray($childXml, $options);
                  list($childTagName, $childProperties) = each($childArray);

                  //replace characters in tag name
                  if ($options['keySearch']) $childTagName =
                          str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                  //add namespace prefix, if any
                  if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

                  if (!isset($tagsArray[$childTagName])) {
                      //only entry with this key
                      //test if tags of this type should always be arrays, no matter the element count
                      $tagsArray[$childTagName] =
                              in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                              ? array($childProperties) : $childProperties;
                  } elseif (
                      is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                      === range(0, count($tagsArray[$childTagName]) - 1)
                  ) {
                      //key already exists and is integer indexed array
                      $tagsArray[$childTagName][] = $childProperties;
                  } else {
                      //key exists so convert to integer indexed array with previous value in position 0
                      $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
                  }
              }
          }

          //get text content of node
          $textContentArray = array();
          $plainText = trim((string)$xml);
          if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;

          //stick it all together
          $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
                  ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

          //return node as array
          return array(
              $xml->getName() => $propertiesArray
          );
      }

      $allowedFileType = ['text/xml'];
      if (in_array($_FILES['userfile']['type'], $allowedFileType)) {
        $dir = 'uploads/penjualan/';
        $file = $dir . time() . '.xml';
        $output = $dir . 'output.csv';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) {
          $xmlNode = simplexml_load_file($file);
          $arrayData = xmlToArray($xmlNode);
          $invoice = $arrayData['NMEXML']['TRANSACTIONS']['SALESINVOICE'];

          if (!$invoice == null) {
            $insert = $this->data_penjualan_model->insert($invoice);
            if ($insert) {
              $this->session->set_flashdata('pjlOk', 'Data Berhasil di-Import!');
            } else {
              $this->session->set_flashdata('pjlError', 'Data Gagal di-Import!');
            }
          } else {
            $this->session->set_flashdata('pjlError', 'Format File Tidak Cocok!');
          }
        } else {
          $this->session->set_flashdata('pjlError', 'Data Gagal di-Upload!');
        }
      } else {
        $this->session->set_flashdata('pjlError', 'Ekstensi File Salah!');
      }
      redirect('/data_penjualan', 'refresh');
    }
  }

}
