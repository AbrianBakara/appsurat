<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Surat Keluar</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="surat_keluar-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("surat_keluar/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal_surat">Tanggal Surat <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-tanggal_surat" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('tanggal_surat',""); ?>" type="datetime" name="tanggal_surat" placeholder="Enter Tanggal Surat" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Tujuan_surat">Tujuan Surat <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-Tujuan_surat"  value="<?php  echo $this->set_field_value('Tujuan_surat',""); ?>" type="text" placeholder="Enter Tujuan Surat"  required="" name="Tujuan_surat"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="Nomor_surat">Nomor Surat <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-Nomor_surat"  value="<?php  echo $this->set_field_value('Nomor_surat',""); ?>" type="text" placeholder="Enter Nomor Surat"  required="" name="Nomor_surat"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body">
                                            <div class="form-group ">
                                                        <label class="control-label" for="id_perihal">Perihal<span class="text-danger">*</span></label>
                                                        <div id="ctrl-id_periahl-holder" class=""> 
                                                            <select required=""  id="ctrl-id_perihal" name="id_perihal"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php 
                                                                $id_perihal_options = $comp_model -> surat_keluar_id_perihal_option_list();
                                                                if(!empty($id_perihal_options)){
                                                                foreach($id_perihal_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = $this->set_field_selected('id_perihal',$value, "");
                                                                ?>
                                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                    <?php echo $label; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
</div>                           
                                            
                                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                                <div class="form-ajax-status"></div>
                                                <button class="btn btn-primary" type="submit">
                                                    Submit
                                                    <i class="fa fa-send"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
