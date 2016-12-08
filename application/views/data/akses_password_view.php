<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 

        <?php $this->load->view('common/head_tab'); ?>
        <?php
        $ubah = (isset($ubah)) ? $ubah : '';
        $alert = $this->session->userdata("error");
        $this->session->unset_userdata("error");
        ?>
        
        <script type="text/javascript">
            error = '<?php echo $error; ?>';
                    ubah = '<?php echo $ubah; ?>';
                    _alert = '<?php echo $alert; ?>';
                    _insert = '<?php echo $this->session->userdata('akses_insert');?>';
                    _edit = '<?php echo $this->session->userdata('akses_edit'); ?>';
                    _delete = '<?php echo $this->session->userdata('akses_delete'); ?>';
					site_url = '<?php echo site_url(); ?>/data/akses_password/';
                    base_url = '<?php echo base_url(); ?>/';
                    window.onload = function() {
                    $('.loading_gif').show();
                    if (error != "")
                    {
						if (ubah != '')
						{
							$('#button').attr("name", "ubah");
							$('#button').attr("value", "Ubah");
							$('#form_akses_password').attr("action", site_url + 'edit');
						}
						show_remodal();
						}

						if (_alert != "")
								alertify.success(_alert);
                    }
			
			function form_insert(){
				if(_insert!='0')
					show_remodal();
				else{
						setTimeout(function() 
							{ 
								$('.loading_gear_gif').hide();
							}, 800);
						alertify.error("Anda tidak mempunyai akses untuk insert!");
					}
			}
			
            function form_edit(index)
            {
 				if(_edit!='0'){
				$('.loading_gear_gif').show(); 
				$.ajax({
				type: "POST",
						url: "<?php echo site_url('data/akses_password/akses_password_show_by_id') ?>",
						timeout: 20000,
						data:
						'datamodel=' + $(index).attr("datamodel")

						, success: function(result) {
						// alert(result);
						if (result != "[]")
						{
						var arr = JSON.parse(result);
								$('#role_id').val(arr[0].role_id);
								$('#akses_password_menu').val(arr[0].akses_password_menu);
								$('#akses_password_fungsi').val(arr[0].akses_password_fungsi);
								$('#datamodel').val(arr[0].datamodel);
								$('#button').attr("name", "ubah");
								$('#button').attr("value", "Ubah");
								$('#form_akses_password').attr("action", site_url + 'edit');
								show_remodal();
						}
						else{
								alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
								$('.loading_gear_gif').hide();
								}
						}

				});
				
				}else{
					alertify.error("Anda tidak mempunyai akses untuk edit!");
				}
            }

            function deleted(index)
            {
                        	if(_delete!='0'){
			confirm("Apakah anda yakin akan menghapus data ini ?", function(e) {
            if (e) {
            $.ajax({
            type: "POST",
                    url: "<?php echo site_url('data/akses_password/delete') ?>",
                    timeout: 20000,
                    data:
                    'datamodel=' + $(index).attr("datamodel")

                    , success: function(result) {
                    if (result == "1")
                    {
                    alertify.success('Hapus sukses');
                            location.reload();
                            window.location.replace("<?php echo site_url('data/akses_password/'); ?>");
                    }
					else if(result == "2")
					{
						alertify.success('Data Tidak Dapat Dihapus');
					}
                    else
                            alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
                            $('.loading_gear_gif').hide();
                    },
                    error: function(html) {
                    alertify.error("Kode Eror [" + html.status + "]<br/><br/>Status:" + html.statusText);
                            $('.loading_gear_gif').hide();
                    }

            });
            } else {
            alertify.error("Anda batal menghapus data detail");
                    $('.loading_gear_gif').hide();
            }
            });
                    }else{
					 alertify.error("Anda tidak mempunyai akses untuk hapus!");
					}
            }

            function close_remodal()
            {
            $('.loading_gear_gif').show();
                    window.location = site_url;
                    hide_remodal();
            }

            function clear_sorting()
            {
            $("#filter_search").val("");
                    location.reload();
            }

            var app = angular.module('main', ['ngTable', 'ngTableExport','picardy.fontawesome']).
                    controller('DemoCtrl', function($scope, $filter, $http, NgTableParams, $sce) {
                    var data = [];
                            $http.get('<?php echo site_url('data/akses_password/akses_password_show'); ?>')
                            .success(function($user) {
                            data = $user;
                                    $scope.tableParams = new NgTableParams({
                                    page: 1, // show first page
                                            count: 100, // count per page
                                            filter: {
                                            akses_password_menu: '', // initial filter
                                            },
                                            sorting: {
                                            akses_password_menu: 'asc'    // initial sorting
                                            }

                                    }, {
                                    data: data,
                                    });
                                    $('.loading_gif').hide();
                            });
							$scope.show = function (index) { //kalau ada parameter dimasukkan ke dalam function ()
								$('.action_bar_' + index).toolbar({
									content: '#toolbar-options-' + index,
									position: 'top',
									style:'warning',
									adjustment: 7
								});
							};
                            //
                    });</script>
    </head>
    <body ng-app="main">
        <div id="container">
            <div class="row">
                
                <div class="col-md-12">
                    <br/>
                    <div ng-controller="DemoCtrl">
                        <div class="row" >
                            <div class="col-md-9">
							</div>
                            <div class="col-md-2" style="padding-right:20px">
                                <a style="" class="btn btn-primary pull-right" ng-mousedown="csv.generate()" ng-href="{{ csv.link()}}" download="akses_password.csv">Export to CSV</a>
                            </div>
                            <div class="col-md-1">
                                <button style="" ng-click="tableParams.sorting({})" onclick="clear_sorting()" class="btn btn-default pull-right">Clear Sorting</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 pull-right" style="margin-top: 1%;" >
                                <input style=""  class="form-control" type="search" id="filter_search" ng-model="user.akses_password_menu" placeholder="Cari Hak Akses..." aria-label="Cari Akses Password" />
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <table ng-table="tableParams"  class="table ng-table-responsive" export-csv="csv">
                                    <tr ng-repeat="(datamodel, user) in $data | filter:user.akses_password_menu as results"  ng-class-odd="'Bg_genap'" ng-class-even="'Bg_ganjil'"  ng-class="{ 'emphasis': user.role_nama == '<?php echo $this->session->userdata("role_nama") ?>'}">
                                        <td class="col-md-8 borderkanan" data-title="'Menu'" sortable="'akses_password_menu'">
                                            <span id="akses_password_menu_{{$index}}" >{{user.akses_password_menu}}</span>
                                        </td>
										<td class="col-md-8 borderkanan" data-title="'Aksi'" sortable="'akses_password_fungsi'">
                                            <span id="akses_password_fungsi_{{$index}}" >{{user.akses_password_fungsi}}</span>
                                        </td>										
                                        <td class="col-md-3 borderkanan" data-title="'Role'" sortable="'role_nama'"> 
                                            <span id="role_nama_{{$index}}" >{{user.role_nama}}</span>  
                                        </td>

                                        <td class="col-md-1" data-title="'Actions'" ng-mouseover="show($index)" >
                                    <center>
										
										 
                                         
										 <fa class="fa-main btn-toolbar btn-toolbar-warning action_bar_{{$index}}" name="gear" size="2"></fa>
											<div id="toolbar-options-{{$index}}" class="hidden">
												<a  title="Ubah Data" href="" id="user-{{$index}}" datamodel={{user.datamodel}}  onclick="form_edit(this)">
										<fa name="edit" size="2"></fa></a>
											
											</div>   
										 </center>
                                    </td>

                                    <a style="display:none" >
                                        <span >{{user.datamodel}}</span>
                                    </a>
                                    </tr> 
                                    <tr ng-if="results.length == 0">
                                        <td colspan="3" >
                                    <center> <strong>Tidak ada data...</strong></center>
                                    </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row" >
                                <!--<span style="padding-right: 26px;margin-top: 126px;">Jumlah data tampil</span>-->
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <?php $this->load->view("data/akses_password_crud_view"); // remodal  ?>
      
        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script> 
    </body>
</html>