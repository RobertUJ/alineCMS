<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

function jquery_ckeditor($data){
  $ck_options = "";
  if(isset($data["options"])){
    $options = $data["options"];
    if(is_array($options)){
      if(count($options) != 0){
         $ck_options = json_encode($options);
      }
    }
  }

  $return = "<script type=\"text/javascript\">\n";
  $return .= "<!--\n";
  $return .=   "$(document).ready(function(){\n";
  $return .=     "$( '".$data['replace']."' ).ckeditor(".$ck_options.");\n";
  $return .=   "});\n";
  $return .= "-->\n";
  $return .= "</script>\n";

  return $return;
}

function ck_includes(){
    return '<script type="text/javascript" src="'.base_url().'assets/admin/ckeditor/ckeditor.js"></script>
            <script type="text/javascript" src="'.base_url().'assets/admin/ckeditor/adapters/jquery.js"></script>';
}

function ck_options_paginas(){
  return array( // las opciones (opcionales)
    "bodyClass" => "ck_custom",
    "contentsCss" => "css/admin_styles.css",
    "language" => "es",
    "width" => 920,
    "toolbar" => 'Full',
    "toolbar_Full" => array(
      array("name" => 'document', "items" => array('Source','-','Print','-','Templates')) ,
      array("name" => 'clipboard', "items" => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo')),
      array("name" => 'basicstyles', "items" => array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat')),
      array("name" => 'styles', "items" => array('Styles','Format','Font','FontSize')),
      '/',
      array("name" => 'paragraph', "items" => array('NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock')),
      array("name" => 'colors', "items" => array('TextColor','BGColor')),
      array("name" => 'editing', "items" => array('Find','Replace','-','SelectAll')),
      array("name" => 'links', "items" => array('Link','Unlink','Anchor')),
      array("name" => 'tools', "items" => array('Maximize', 'ShowBlocks','-','About')),
      array("name" => 'insert', "items" => array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'))
  ),
    "toolbar_CUSTOM" => array(
      array("name" => 'clipboard', "items" => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo')),
      array("name" => 'styles', "items" => array('Styles','Format','Font','FontSize')),
      '/',
      array("name" => 'basicstyles', "items" => array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat')),
      array("name" => 'paragraph', "items" => array('NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock')),
      array("name" => 'colors', "items" => array('TextColor','BGColor')),
      array("name" => 'editing', "items" => array('Find','Replace','-','SelectAll')),
      array("name" => 'links', "items" => array('Link','Unlink','Anchor')),
    ),

        "filebrowserBrowseUrl" => base_url()      . "assets/admin/ckeditor/kcfinder/browse.php?type=files",
        "filebrowserImageBrowseUrl" => base_url() . "assets/admin/ckeditor/kcfinder/browse.php?type=images",
        "filebrowserFlashBrowseUrl" => base_url() . "assets/admin/ckeditor/kcfinder/browse.php?type=flash",

        "filebrowserUploadUrl" => base_url()      . "assets/admin/ckeditor/kcfinder/upload.php?type=files",
        "filebrowserImageUploadUrl" => base_url() . "assets/admin/ckeditor/kcfinder/upload.php?type=images",
        "filebrowserFlashUploadUrl" => base_url() . "assets/admin/ckeditor/kcfinder/upload.php?type=flash",

  );
}

function ck_options(){
  return array( // las opciones (opcionales)
    "bodyClass" => "ck_custom",
    "contentsCss" => "css/admin_styles.css",
    "language" => "es",
    "width" => 720,
    "toolbar" => 'Full',
    "toolbar_Full" => array(
      array("name" => 'document', "items" => array('Source','-','Print','-','Templates')) ,
      array("name" => 'clipboard', "items" => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo')),
      array("name" => 'styles', "items" => array('Styles','Format','Font','FontSize')),
      '/',
      array("name" => 'paragraph', "items" => array('NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock')),
      array("name" => 'colors', "items" => array('TextColor','BGColor')),
      array("name" => 'editing', "items" => array('Find','Replace','-','SelectAll')),
      array("name" => 'links', "items" => array('Link','Unlink','Anchor')),
      array("name" => 'tools', "items" => array('Maximize', 'ShowBlocks','-','About')),
      array("name" => 'insert', "items" => array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'))
  ),
    "toolbar_CUSTOM" => array(
      array("name" => 'clipboard', "items" => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo')),
      array("name" => 'styles', "items" => array('Styles','Format','Font','FontSize')),
      '/',
      array("name" => 'basicstyles', "items" => array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat')),
      array("name" => 'paragraph', "items" => array('NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock')),
      array("name" => 'colors', "items" => array('TextColor','BGColor')),
      array("name" => 'editing', "items" => array('Find','Replace','-','SelectAll')),
      array("name" => 'links', "items" => array('Link','Unlink','Anchor')),
    ),

        "filebrowserBrowseUrl" => base_url() . "assets/admin/ckeditor/kcfinder/browse.php?type=files",
        "filebrowserImageBrowseUrl" => base_url() . "assets/admin/ckeditor/kcfinder/browse.php?type=images",
        "filebrowserFlashBrowseUrl" => base_url() . "assets/admin/ckeditor/kcfinder/browse.php?type=flash",

        "filebrowserUploadUrl" => base_url() . "assets/admin/ckeditor/kcfinder/upload.php?type=files",
        "filebrowserImageUploadUrl" => base_url() . "assets/admin/ckeditor/kcfinder/upload.php?type=images",
        "filebrowserFlashUploadUrl" => base_url() . "assets/admin/ckeditor/kcfinder/upload.php?type=flash",


  );
}

/* Fin de jquery_ckeditor */