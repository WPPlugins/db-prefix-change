<?php 
class BoostrapCodes {
	/**
	 * Create a null object of BoostrapCodes
	 *
	 * @return BoostrapCodes $cdprefixPlugin_AdminObj
	 */
	public  function Create() {
		return 	$BoostrapCodesObj = new BoostrapCodes();
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_table
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_table($type,$thead = null,$tbody = null,$endtable = true,$colspan = null){
		$output = '';
		$output .= '<table class="table ' . $type . '">';
		$output .= ($thead) ? bootstrap_thead($thead) : '';
		$output .= ($tbody) ? bootstrap_tbody($tbody,$colspan) : '';
		$output .= ($endtable == true) ? bootstrap_endtable() : '';
		return $output;
	}
	public function bootstrap_thead($thead){
		$html = '<tr>';
		foreach ($thead as $col):
		$html .= '<th>' . $col . '</th>';
		endforeach;
		$html .= '</tr>';
		return $html;
	}
	public function bootstrap_tbody($tbody,$colspan = null,$trclass =''){
		$total = count($tbody);
		if($trclass != '') $trclass = ' class="'.$trclass.'"';
		if($colspan != '') $cols = ' colspan="'.$colspan.'"';
		if(is_array($tbody) && is_multidimension($tbody)){
			foreach ($tbody as $tr):
			$html .= "<tr$trclass>";
			$counter = 1;
			foreach ($tr as $datum):
			$html .= "<td$cols>" . $datum . '</td>';
			endforeach;
			$html .= '</tr>';
			endforeach;
		}else{
			$html = "<tr$trclass>";
			$counter = 1;
			if($colspan != '') $cols = ' colspan="'.$colspan.'"';
	
			if(isset($tbody) && !is_array($tbody))
				$html .= "<td$cols>" . $tbody . '</td>';
			else{
				foreach ($tbody as $datum):
				$html .= "<td$cols>" . $datum . '</td>';
				endforeach;
			}
		}
		$html .= '</tr>';
		return $html;
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_endtable
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public	function bootstrap_endtable(){
		return '</table>';
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bs_panel
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_panel($type,$xclass,$title = null, $content = null,$footer = null) {
	
		$class  = 'panel';
		$class .= ($type) ? ' panel-' . $type : ' panel-default';
		$class .= ($xclass) ? ' ' . $xclass : '';
		$footer = ($footer) ? '<div class="panel-footer">' . $footer . '</div>' : '';
	
		$html = '<div class="' . $class . '">';
		if($title!=''){
			$html .='<div class="panel-heading">' .
					'<h3 class="panel-title">' . $title . '</h3>' .
					'</div>' .
					'<div class="panel-body">' . $content . '</div>';
		}else{
			$html .= $content;
		}
		$html .= $footer.'</div>';
		return $html;
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bs_img
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_img($type, $xclass, $responsive, $content = null,$extra =null) {
		$class .= ($type) ? 'img-' .$type. '' : '';
		$class .= ($responsive == 'true') ? ' img-responsive' : '';
		$class .= ($xclass) ? ' ' . $xclass : '';
		$return = '';
		$return = '<img src="'.$content.'" class="'.$class.'" '.$extra.' />';
		return $return;
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bs_video
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_video( $type, $xclass, $content = null,$extra =null,$autoplay=true,$poster=false) {
		$type = ($type) ? $type : '';//video/mp4
		$class = ($xclass) ? ' ' . $xclass : '';
		$aplay = ($autoplay == true) ? 'autoplay' : '';
		$poster_set = ($poster == true) ? 'poster="images/poster.png"' : '';
		$return = '<video class="'.$class.'" '.$extra.' '.$aplay.' '.$poster_set.'><source src="'.$content.'" type="'.$type.'" ></source></video>';
		return $return;
	}
	
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_column
	*
	* @author Bhumi Shah
	* @since 3.0
	* @grid pull and offset
	*-------------------------------------------------------------------------------------*/
	
	public function bootstrap_column($content,$grid = null,$offset = null,$pull = null,$push = null,$extra = null) {
		$class  = '';
		$class .= ($grid['col'] == 'lg')   ? ' col-lg-' . $grid['lg_column'] : '';
		$class .= ($grid['col'] == 'md')   ? ' col-md-' . $grid['md_column'] : '';
		$class .= ($grid['col'] == 'sm')   ? ' col-sm-' . $grid['sm_column'] : '';
		$class .= ($grid['col'] == 'xs')   ? ' col-xs-' . $grid['xs_column'] : '';
		$class .= ($offset['lg']) ? ' col-lg-offset-' . $offset['lg_column'] : '';
		$class .= ($offset['md']) ? ' col-md-offset-' . $offset['md_column'] : '';
		$class .= ($offset['sm']) ? ' col-sm-offset-' . $offset['sm_column'] : '';
		$class .= ($offset['xs']) ? ' col-xs-offset-' . $offset['xs_column']: '';
		$class .= ($pull['lg'])   ? ' col-lg-pull-' . $pull['lg_column'] : '';
		$class .= ($pull['md'])   ? ' col-md-pull-' . $pull['md_column'] : '';
		$class .= ($pull['sm'])   ? ' col-sm-pull-' . $pull['sm_column'] : '';
		$class .= ($pull['xs'])   ? ' col-xs-pull-' . $pull['xs_column'] : '';
		$class .= ($push['lg'])   ? ' col-lg-push-' . $push['lg_column'] : '';
		$class .= ($push['md'])   ? ' col-md-push-' . $push['md_column'] : '';
		$class .= ($push['sm'])   ? ' col-sm-push-' . $push['sm_column'] : '';
		$class .= ($push['xs'])   ? ' col-xs-push-' . $push['xs_column'] : '';
		$class .= ($xclass)       ? ' ' . $xclass : '';
	
		return sprintf('<div class="%s" %s>%s</div>',$class,$extra, $content );
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_list_group
	*
	* @author Bhumi Shah
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_list_group($content = null, $linked = false, $xclass = null ) {
		$class  = 'list-group';
		$class .= ($xclass) ? ' '.$xclass : '';
	
		return sprintf('<%1$s class="%2$s">%3$s</%1$s>',($linked == 'true') ? 'div' : 'ul',$class,$content);
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_list_group_item
	*
	* @author Bhumi Shah
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_list_group_item($content = null,$type = null,$link=false,$active=false,$target=null,$xclass=null ) {
	
		$class  = 'list-group-item';
		$class .= ($type) ? ' list-group-item-' .$type : '';
		$class .= ($active  == 'true' ) ? ' active' : '';
		$class .= ($xclass) ? ' ' .$xclass : '';
	
		return sprintf('<%1$s %2$s %3$s class="%4$s">%5$s</%1$s>',($link) ? 'a' : 'li',($link) ? 'href="' .$link. '"' : '',($target) ? sprintf(' target="%s"', ($target)) : '', $class,$content);
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_badge
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_badge($content,$type = null,$right=false,$xclass=null) {
	
		$class  = 'badge';
		$class .= ($type) ? ' badge-'.$type : ' badge-default';
		$class .= ($right == 'true' ) ? ' pull-right' : '';
		$class .= ($xclass) ? ' '.$xclass : '';
	
		return sprintf('<span class="%s">%s</span>',$class,$content);
	}
	
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_tag_list
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_tag_list($content,$type = null,$ul_id=null,$xclass=null,$div_content=null) {
	
		$class  = 'well';
		$class .= ($type) ? ' well-'.$type : ' well-sm';
		$class .= ($xclass) ? ' '.$xclass : '';
		return sprintf('<div class="%s"><ul id="%s">%s</ul>%s</div>',$class,$ul_id,$content,$div_content);
	}
	
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_tag_list_item
	*
	* @author Bhumi Shah
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_tag_list_item($content = null,$type = null,$xclass=null,$id = null) {
		$class  = 'tag-cloud';
		$class .= ($type) ? ' tag-cloud-'.$type : ' tag-cloud-default';
		$class .= ($xclass) ? ' '.$xclass : '';
	
		return sprintf('<li class="%s" id="%s">%s</li>',$class,$id,$content);
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_label
	*
	* @author Bhumi Shah
	* @since 3.0
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_label($content,$type = null,$right=false,$xclass=null) {
	
		$class  = 'label';
		$class .= ($type) ? ' label-'.$type : ' label-default';
		$class .= ($right == 'true' ) ? ' pull-right' : '';
		$class .= ($xclass) ? ' '.$xclass : '';
	
		return sprintf('<span class="%s">%s</span>',$class,$content);
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_dropdown
	*
	* @author Bhumi Shah
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_dropdown($content,$data = null,$xclass = null ) {
		$class  = 'dropdown-menu';
		$class .= ($xclass) ? ' ' . $xclass: '';
	
		return sprintf('<ul role="menu" class="%s" %s>%s</ul>',$class,$data,$content);
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_dropdown_item
	*
	* @author Bhumi Shah
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_dropdown_item($content,$link= '#',$data = null,$xclass = null,$disabled=false) {
		$li_class  = '';
		$li_class .= ($disabled == 'true' ) ? ' disabled' : '';
		$a_class  = '';
		$a_class .= ($xclass) ? ' ' . $xclass : '';
	
		return sprintf('<li role="presentation" class="%s"><a role="menuitem" href="%s" class="%s" %s>%s</a></li>',$li_class, $link,$a_class,$data,$content);
	}
	/*--------------------------------------------------------------------------------------
	 *
	* BootStrap Alerts
	* @type  : alert-info, alert-success, alert-error
	* @close : display close link
	* @author Bhumi Shah
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_alert( $type = 'info',$close = false, $content = null, $xclass = '',$msg_head = '') {
	
		$class  = 'alert';
		$class .= ($type) ? ' alert-' . $type : ' alert-success';
		$class .= ($xclass) ? ' ' . $xclass : '';
	
		$out = '<div class="'.$class.'">';
		if($close == 'true') {
			$out .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
		}
		$message_head  = ($msg_head != '') ? '<strong>'.$msg_head.'!</strong> ' : '';
		$out .= $message_head;
		$out .= $content;
		$out .= '</div>';
	
		return $out;
	}
	/*
	 *
	*/
	public function bootstrap_modal_btn($id,$btn_class,$btntext,$xtra=null){
	
		return sprintf(
				'<button type="button" class="%2$s" data-toggle="modal" data-target="#%1$s" %4$s>%3$s</button>', $id , $btn_class, $btntext,$xtra);
	}
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_modal
	*
	* $btntext = Button to activate a modal
	* $title = Title on button
	* $size = modal size if require
	* $xclass = extra class of button
	* $content = modal body content
	* $id = modal box id
	* $title_id = Modal Header Title
	* $form_id = Modal form id
	* $footer = Footer content
	*
	* @author Bhumi Shah
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_modal($btntext,$title,$size=null,$xclass = null, $content = null,$id = null,$title_id = null,$form_id=null,$form_class=null,$footer=null,$show_btn = true) {
	
		$btn_class  = '';
		$btn_class .= ($xclass) ? ' '.$xclass : '';
	
		$div_class  = 'modal fade';
		$div_class .= ($size) ? ' bs-modal-' . $size : '';
	
		$div_size = ($size) ? ' modal-' . $size : '';
	
		$id = ($id) ? $id : 'custom-modal-' . md5( $title );
		$title_id = ($title_id) ? $title_id : 'custom-title';
		$form_id = ($form_id) ? $form_id : 'modalForm';
		$head_title = ($title) ? '<h4 class="modal-title" id="'.$title_id.'">' . $title . '</h4>' : '';
		$btn = ($show_btn== true) ? bootstrap_modal_btn($id,$btn_class,$btntext) :'';
		return sprintf(
				'%2$s
			<div class="%4$s" id="%1$s" tabindex="-1" role="dialog" ria-hidden="true" aria-labelledby="#%7$s" >
            <div class="modal-dialog %5$s">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
                        %6$s
                    </div>
					<form class="%10$s" id="%8$s" name="%8$s" method="post" action="" >
	                    <div class="modal-body">
	                        %3$s
	                    </div>
						<div class="modal-footer">
						 %9$s
	                    </div>
					</form>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
      ', $id , $btn , $content, $div_class, $div_size,$head_title,$title_id,$form_id,$footer,$form_class);
	}
	/*
	 * Bootstrap Switch
	* @chkname : checkbox name
	* @chkvalue : Value of Checkbox
	* @selected : checked value of checkbox
	* @xclass : Extra Class
	* @lblclass : Label Class
	*
	* @author Bhumi Shah
	*
	*/
	public function bootstrap_switch($chkname,$chkvalue,$selected=null,$xclass=null,$lblclass=null){
		$class  = 'seen seen-switch seen-switch-bootstrap';
		$class .= ($xclass) ? ' ' . $xclass : '';
		$selected = ($chkvalue == $selected) ? 'checked="checked"': '';
		return sprintf('<label class="%1$s"><input type="checkbox" class="%2$s" name="%3$s" id="%3$s" value="%4$s" %5$s><span class="lbl"></span></label><span class="hide">%4$s</span> ', $lblclass , $class , $chkname, $chkvalue, $selected);
	}
	/*
	 * Bootstrap Loader
	* @$div_id : checkbox name
	* @$loader_type : Value of Checkbox
	* @$loader_size : checked value of checkbox
	* @alert_type : Extra Class
	* @xclass : Extra Class
	*
	* @author Bhumi Shah
	*
	*/
	public function bootstrap_loader($div_id,$loader_type,$loader_size,$alert_type,$xclass){
	
		$class = ($alert_type) ? ' bg-' . $alert_type : ' bg-info';
		$loader = 'fa';
		$loader .= ($loader_type) ? ' fa-'. $loader_type : ' fa-spinner fa-pulse';
		$size .= ($loader_size) ? ' fa-'. $loader_size : '';
		$div_id = ($divid) ? $divid : 'loader';
		$xclass = ($xclass) ? ' ' . $xclass : '';
		return sprintf('<div id="%1$s">
						<div class="%2$s">
							<div class="loader text-center">
								<i class="%3$s %4$s %5$s"></i>
							</div>
						</div>
					</div>', $div_id , $class , $loader,$size, $xclass);
	}	
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_nav
	*
	*
	*-------------------------------------------------------------------------------------*/
	public function bootstrap_nav( $type,$stacked =false,$justified =false,$xclass= null , $content = null ) {
	
		$class  = 'nav';
		$class .= ( $type )         ? ' nav-' . $type : ' nav-tabs';
		$class .= ( $stacked   == 'true' )      ? ' nav-stacked' : '';
		$class .= ( $justified == 'true' )    ? ' nav-justified' : '';
		$class .= ( $xclass )       ? ' ' . $xclass : '';
	
		return sprintf('<ul class="%s"%s>%s</ul>',$class,$content);
	}
	
	/*--------------------------------------------------------------------------------------
	 *
	* bootstrap_nav_item
	*
	*
	*-------------------------------------------------------------------------------------*/
	function bootstrap_nav_item( $link,  $active = false,  $disabled= false,  $dropdown = null,  $xclass, $content = null ) {
		
		$li_classes  = '';
		$li_classes .= ( $dropdown ) ? 'dropdown' : '';
		$li_classes .= ( $active   == 'true' )   ? ' active' : '';
		$li_classes .= ( $disabled == 'true' ) ? ' disabled' : '';
		$a_classes  = '';
		$a_classes .= ( $dropdown   == 'true' ) ? ' dropdown-toggle' : '';
		$a_classes .= ( $xclass )   ? ' ' . $xclass : '';
		$content = ( $dropdown ) ? str_replace( '[dropdown]', '</a>[dropdown]', $content ) : $content . '</a>';
				return sprintf('<li%1$s><a href="%2$s"%3$s%4$s%5$s>%6$s</li>',
						( ! empty( $li_classes ) ) ? sprintf( ' class="%s"', ( $li_classes ) ) : '',
						( $atts['link'] ),
								( ! empty( $a_classes ) )  ? sprintf( ' class="%s"', ( $a_classes ) )  : '',
								( $atts['dropdown'] )   ? ' data-toggle="dropdown"' : '',
										( $data_props ) ? ' ' . $data_props : '',
										( $content )
								);
	}
}
?>