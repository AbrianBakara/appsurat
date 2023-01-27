<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >The Dashboard</h4>
                </div>
                
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_surat_proyek();  ?>
                    <a href="<?php print_link("surat_keluar/") ?>">
                    
                    <div class="row">
                            <div class="col-2">
                                <i class="fa fa-paper-plane fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Nomor Surat Proyek</div>
                                    <small class=""></small>
                                </div>
                                <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                            </div>
                           
                        </div>
                    </a> 
                </div>
                    <?php $rec_count = $comp_model->getcount_surat_magang();  ?>
                    <a href="<?php print_link("surat_keluar/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-paper-plane fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Nomor Surat Magang</div>
                                    <small class=""></small>
                                </div>
                                <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                            </div>
                           
                        </div>
                    </a>
                    
                    
                    
                    
                </div>
               
                </div>
            </div>
        </div>
    </div>
</div>
