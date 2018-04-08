<?php

function has_content($key) {
  global $content;
  return isset($content[$key]);
}

function yield_content($key = 'default', $echo = true) {
  global $content;

  $out = has_content($key) ? $content[$key] : '';

  if ($echo) {
    echo $out;
  } else {
    return $out;
  }
}

function javascripts() {
  global $content;
  if (!isset($content['javascripts'])) $content['javascripts'] = '';

  $args = func_get_args();
  foreach($args as $script) {
    if (substr($script, 0, 7) != 'http://') {
      $script = "js/$script.js";
    }
    $content['javascripts'] .= '<script src="'.$script.'"></script>' . "\xA    ";
  }
}

function stylesheets() {
  global $content;
  if (!isset($content['stylesheets'])) $content['stylesheets'] = '';

  $args = func_get_args();
  foreach($args as $style) {
    if (substr($style, 0, 7) != 'http://') {
      $style = "css/$style.css";
    }
    $content['stylesheets'] .= '<link rel="stylesheet" href="'.$style.'">' . "\xA    ";
  }
}

function title($title) {
  global $content;
  $content['title'] = $title;
}

function debug($data){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

if (!function_exists('generateTemplate')) {
  function generateTemplate($templateName){
    global $content, $template;
    $template = $templateName.'.tpl.php';
    ob_start();
    if (file_exists(DIR_PATH.PARTIAL_PATH.$template)) {
        include(DIR_PATH.PARTIAL_PATH.$template);
    } else {
        echo "<br />Error 404 : Template not found.<br />";
    }
    $content[$templateName] = ob_get_contents();
    ob_end_clean();
    return $templateName;
  }
}

if (!function_exists('showMetaTags')) {
    function showMetaTags($meta_title, $meta_description, $meta_keywords, $return = false)
    {
        global $content;
        if (isset($meta_description) && !empty($meta_description)) {
            $meta_description = $meta_description;
        } else {
            $meta_description = $meta_title;
        }

        if (isset($meta_keywords) && !empty($meta_keywords)) {
            $meta_keywords = $meta_keywords;
        } else {
            $meta_keywords = $meta_title;
        }
        $request_uri = str_replace('/index', '', $_SERVER["REQUEST_URI"]);
        $canonical_url = SERVER_PROTOCOL.'://'.$_SERVER['HTTP_HOST'].$request_uri;
        
        

        $meta_tags = '';

        if (isset($meta_description) && !empty($meta_description)) {
            $meta_tags .= '<meta name="description" content="'.$meta_description.'"/><meta property="og:description" content="'.$meta_description.'"/>';
        }

        if (isset($meta_keywords) && !empty($meta_keywords)) {
            $meta_tags .= '<meta name="keywords" content="'.$meta_keywords.'"/>';
        }

        if (isset($canonical_url) && !empty($canonical_url)) {
            $meta_tags .= '<link rel="canonical" href="'.$canonical_url.'" /><meta property="og:url" content="'.$canonical_url.'"/>';
        }

        if (isset($page_title) && !empty($page_title)) {
            $meta_tags .= '<title>'.$page_title.'</title><meta property="og:title" content="'.$page_title.'"/>';
        }
        

        if ($return == false) {
            $content['meta_tags'] = $meta_tags;
        } else {
            return $meta_tags;
        }
    }
}

?>
