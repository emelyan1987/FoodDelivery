<?php
class image_resize extends CI_Model{
  var $original_path;
  var $resized_path;
  var $thumbs_path;
 
  //initialize the path where you want to save your images
  function __construct(){
    parent::__construct();
    //return the full path of the directory
    //make sure these directories have read and write permessions
    $this->original_path = realpath('http://www.wallpapereast.com/static/images/6860321-wallpaper-hd.jpg');
    $this->resized_path = realpath('http://www.wallpapereast.com/static/images/6860321-wallpaper-hd.jpg');
    $this->thumbs_path = realpath('http://www.wallpapereast.com/static/images/6860321-wallpaper-hd.jpg');
  }
 
  function do_upload(){
    $this->load->library('image_lib');
    $config = array(
    'allowed_types'     => 'jpg|jpeg|gif|png', //only accept these file types
    'max_size'          => 2048, //2MB max
    'upload_path'       => $this->original_path //upload directory
  );
 
    $this->load->library('upload', $config);
    $image_data = $this->upload->data(); //upload the image
    print_r($image_data);
    echo "<br>";
    //your desired config for the resize() function
    $config = array(
    'source_image'      => $image_data['full_path'], //path to the uploaded image
    'new_image'         => $this->resized_path, //path to
    'maintain_ratio'    => true,
    'width'             => 128,
    'height'            => 128
    );
 
    //this is the magic line that enables you generate multiple thumbnails
    //you have to call the initialize() function each time you call the resize()
    //otherwise it will not work and only generate one thumbnail
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
 
    $config = array(
    'source_image'      => $image_data['full_path'],
    'new_image'         => $this->thumbs_path,
    'maintain_ratio'    => true,
    'width'             => 36,
    'height'            => 36
    );
    //here is the second thumbnail, notice the call for the initialize() function again
    echo $this->image_lib->initialize($config);
    echo $this->image_lib->resize();
  }
}

?>