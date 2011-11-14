<?php

function dv_bootstrap_breadcrumbs($nodes, $divider = '/') {
  $html = '<ul class="breadcrumb">';
  $last = count($nodes) - 1;
  for($i=0;$i<count($nodes);$i++) {
    $isLast = ($i == $last);

    $node = $nodes[$i];
    $text = $node['text'];
    if (isset($node['url'])) {
      $url = $node['url'];
    } else {
      $routeParams = isset($node['route_params']) ? $node['route_params'] : array();
      $url = url_for($node['route'], $routeParams);
    }
    if (!$isLast) {
      $html .= '<li><a href="'.$url.'">'.$text.'</a> <span class="divider">'.$divider.'</span></li>';
    } else {
      $html .= '<li class="active">'.$text.'</li>';
    }
  }
  $html .= '</ul>';
  return $html;
}
