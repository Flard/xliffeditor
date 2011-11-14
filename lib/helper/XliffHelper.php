<?php

function icon_tag($icon, $title = '') {
  return image_tag('/images/icons/'.$icon.'.png', array(
   'width' => 16,
   'height' => 16,
   'class' => 'icon'
  )).' ';
}

