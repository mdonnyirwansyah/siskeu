<?php
use Dompdf\Dompdf;
use Dompdf\Options;

function generatePdf($html1='',$filename='document',$size='A4',$orientation='landscape',$attachment=false){
  $options = new Options();
  $options->setIsRemoteEnabled(true);

  $dompdf = new Dompdf($options);
  $dompdf->loadHtml($html1, 'UTF-8');

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper($size, $orientation);

  // Render the HTML as PDF
  $dompdf->render();
  // Output the generated PDF to Browser

  $dompdf->stream($filename,['Attachment'=>$attachment]);
}

function admin_logged_in() {
  $ci = get_instance();
  if( !$ci->session->userdata('email') ) {
    redirect('auth');
  } else {
    $role_id = $ci->session->userdata('role_id');
    $menu = $ci->uri->segment(1);

    if( $menu == 'admin' && $role_id != 2 ) {
      redirect('error_');
    }
  }
   
}

function user(){
  $ci = get_instance();
  return $ci->db->get_where('tb_user', ['email' => $ci->session->userdata('email')])->row_array();
}

function pimpinan_logged_in() {
  $ci = get_instance();
  if( !$ci->session->userdata('email') ) {
    redirect('auth');
  } else {
    $role_id = $ci->session->userdata('role_id');
    $menu = $ci->uri->segment(1);

    if( $menu == 'pimpinan' && $role_id != 1 ) {
      redirect('error_');
    }
  }
   
}