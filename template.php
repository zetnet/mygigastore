<?php

/**
 * Displays a view of products referenced from the given node, in a megarow.
 */
function mygigastore_process_product_variations_view($node) {
  $title = t('Variations for product %title', array('%title' => $node->title));
  $output = views_embed_view('birou_administare_variante_preparate', 'default', $node->nid);

  return views_megarow_display($title, $output, $node->nid);
}


/** 
 * Page preprocessor we use to check to see if there is the sidebar and then pass it on to the node level 
 * @param $vars 
 * @return unknown_type 
 */ 

/*function mygigastore_process_page(&$vars)
{ 
//GB: We want the Node, if it's exists to know about the $sidebar_first and if it's loaded as it will determine what image style to use 
  if(isset($vars["page"]["sidebar_first"]))
  {
    // add the flag to the node to say it's been set and there is only a single node to display 
    if(isset($vars["page"]["content"]["system_main"]["nodes"]) && count($vars["page"]["content"]["system_main"]["nodes"]) == 2)
	{ 
      $keys = array_keys($vars["page"]["content"]["system_main"]["nodes"]); 
      // Set a new variable called sidebar_first equal to true on the node.tpl level 
      $vars["page"]["content"]["system_main"]["nodes"][$keys[0]]['#node']->sidebar_first = true; 
    } 
	
  }  
dpm($vars);
} 
*/
function mygigastore_preprocess_page(&$variables) {
  if (arg(0)=='node' && is_numeric(arg(1))) {
  //dpm($variables);
  
  //am adaugat eu in sept 2013 doar linia cu  if-ul de mai jos pt. ca dadea ceva notice-uri:
   // Notice: Undefined index: nodes în mygigastore_preprocess_page() (linia 41 din /home/mygigast/public_html/sites/all/themes/mygigastore/template.php).
   // Warning: array_keys() expects parameter 1 to be array, null given în mygigastore_preprocess_page() (linia 41 din /home/mygigast/public_html/sites/all/themes/mygigastore/template.php).

  if(isset($variables["page"]["content"]["content"]["content"]["system_main"]["nodes"])){
	  $keys = array_keys($variables["page"]["content"]["content"]["content"]["system_main"]["nodes"]);
	  // Do logic here
  }
	  if (isset($variables["page"]["content"]["content"]["sidebar_first"]) || isset($variables["page"]["content"]["content"]["sidebar_second"])) {
		$variables["page"]["content"]["content"]["content"]["system_main"]["nodes"][$keys[0]]['#node']->sidebars = true; //or false
	  }
  }
}
 
/*function mygigastore_process_node(&$variables, $hook) {
  //observe that our flag was passed
  if (arg(0)=='node' && is_numeric(arg(1))) {
  //dpm($variables);
  }
}
*/