<!--?php <br ?-->
<?php
/* function that generate the action buttons edit, delete
* This is just showing the idea you can use it in different view or whatever fits your needs
*/
function get_buttons($id)
{
$ci= & get_instance();
$html='<span>';
$html .='<a href="'.  base_url().'subscriber/edit/'.$id.'"><img alt="" src="'.  base_url().'assets/images/edit.png" /></a>';
$html .='<a href="'.  base_url().'subscriber/delete/'.$id.'"><img alt="" src="'.  base_url().'assets/images/delete.png" /></a>';
$html.='</span>';
 
return $html;
}
?>