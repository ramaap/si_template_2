<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 

        <?php $this->load->view('common/head'); ?>
        <?php $this->load->view('common/menu'); ?>
        <?php
        $ubah = (isset($ubah)) ? $ubah : '';
        $alert = $this->session->userdata("error");
        $this->session->unset_userdata("error");
        ?>

        <script type="text/javascript">
            error = '<?php echo $error; ?>';
                    ubah = '<?php echo $ubah; ?>';
                    _alert = '<?php echo $alert; ?>';
                    _insert = '<?php echo $this->session->userdata('akses_insert'); ?>';
                    _edit = '<?php echo $this->session->userdata('akses_edit'); ?>';
                    _delete = '<?php echo $this->session->userdata('akses_delete'); ?>';
                    site_url = '<?php echo site_url(); ?>/data/akses_menu/';
                    base_url = '<?php echo base_url(); ?>/';
                    window.onload = function() {
                    $('.loading_gif').show();
                            if (error != "")
                    {
                    if (ubah != '')
                    {
                    $('#button').attr("name", "ubah");
                            $('#button').attr("value", "Ubah");
                            $('#form_akses_menu').attr("action", site_url + 'edit');
                    }
                    show_modal_bootstrap();
                    }

                    if (_alert != "")
                            alertify.success(_alert);
                    }

            function form_edit(index)
            {
            if (_edit != '0'){
            $('.loading_gear_gif').show();
                    $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('data/akses_menu/akses_menu_show_by_id') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + $(index).attr("datamodel")

                            , success: function(result) {
                            if (result != "[]")
                            {
                            var arr = JSON.parse(result);
                                    $('#role_id').val(arr[0].role_id);
                                    $('#role_nama').val(arr[0].role_nama);
                                    $('#datamodel').val(arr[0].datamodel);
                                    select(arr);
                                    $('#button').attr("name", "ubah");
                                    $('#button').attr("value", "Ubah");
                                    $('#form_akses_menu').attr("action", site_url + 'edit');
                                    $("#idm_tab").trigger("click");
                                    show_modal_bootstrap();
                            }
                            else
                                    alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
                                    $('.loading_gear_gif').hide();
                            }

                    });
            } else{
            alertify.error("Anda tidak mempunyai akses untuk edit!");
            }
            }

            function select(arr)
            {
            //=======================================================
            dm_role = (arr[0].dm_role == 1) ? 1 : 0;
                    document.getElementById("role_mn_dm").checked = dm_role;
                    dm_role_aksis = arr[0].dm_role_aksi.split('~');
                    dm_role_aksi1 = (dm_role_aksis[0] == 1) ? 1 : 0;
                    document.getElementById("role_tb_dm").checked = dm_role_aksi1;
                    dm_role_aksi2 = (dm_role_aksis[1] == 1) ? 1 : 0;
                    document.getElementById("role_ed_dm").checked = dm_role_aksi2;
                    dm_role_aksi3 = (dm_role_aksis[2] == 1) ? 1 : 0;
                    document.getElementById("role_del_dm").checked = dm_role_aksi3;
                    //====================================================================
                    dm_user = (arr[0].dm_user == 1) ? 1 : 0;
                    document.getElementById("user_mn_dm").checked = dm_user;
                    dm_user_aksis = arr[0].dm_user_aksi.split('~');
                    dm_user_aksi1 = (dm_user_aksis[0] == 1) ? 1 : 0;
                    document.getElementById("user_tb_dm").checked = dm_user_aksi1;
                    dm_user_aksi2 = (dm_user_aksis[1] == 1) ? 1 : 0;
                    document.getElementById("user_ed_dm").checked = dm_user_aksi2;
                    dm_user_aksi3 = (dm_user_aksis[2] == 1) ? 1 : 0;
                    document.getElementById("user_del_dm").checked = dm_user_aksi3;
                    //====================================================================

                    dm_akses_menu = (arr[0].dm_akses_menu == 1) ? 1 : 0;
                    document.getElementById("akses_menu_mn_dm").checked = dm_akses_menu;
                    dm_akses_menu_aksis = arr[0].dm_akses_menu_aksi.split('~');
                    dm_akses_menu_aksi2 = (dm_akses_menu_aksis[1] == 1) ? 1 : 0;
                    document.getElementById("akses_menu_ed_dm").checked = dm_akses_menu_aksi2;
                    //=======================================================

                    dm_restore = (arr[0].pg_restore == 1) ? 1 : 0;
                    document.getElementById("restoredatabase_mn_dm").checked = dm_restore;
                    dm_backup = (arr[0].pg_backup == 1) ? 1 : 0;
                    document.getElementById("backupdatabase_mn_dm").checked = dm_backup;
                    dm_profile = (arr[0].pg_profile == 1) ? 1 : 0;
                    document.getElementById("profile_mn_dm").checked = dm_profile;
                    dm_log = (arr[0].pg_log == 1) ? 1 : 0;
                    document.getElementById("lqoxg_mn_dm").checked = dm_log;
                    document.getElementById("datamodel").value = arr[0].datamodel;
                    cek_menu_all();
            }

            function cek_menu_all()
            {
            // cekall(document.getElementById("dm_all"));
            cekall(document.getElementById("all"));
            }

            function cekall(click)
            {

            data = arr = click.name.split("_");
                    group = $('*[id*=' + data[0] + ']:checked').length;
                    // alert(click.name+" | "+group); 
                    if (click.name == 'tb_all' && group >= 8 && click.checked == false)
            {
            click.checked = true;
            }
            else if (click.name == 'ed_all' && group >= 8 && click.checked == false)
            {
            click.checked = true;
            }
            else if (click.name == 'del_all' && group >= 8 && click.checked == false)
            {
            click.checked = true;
            }
            // else if (click.name == 'dm_all' && group >= 112 && click.checked == false)
            else if (click.name == 'all' && group >= 112 && click.checked == false)
            {

            click.checked = true;
            }
            else if (click.name == 'mn_all' && group >= 8 && click.checked == false)
            {

            click.checked = true;
            }
            }


            function deleted(index)
            {
            // if(akses_delete=="0")
            // {
            // alert("Anda tidak punya akses menghapus data ini!");
            // reload();
            // }
            // else{  
            confirm("Apakah anda yakin akan menghapus data ini ?", function(e) {
            $('.loading_gear_gif').show();
                    if (e) {
            $.ajax({
            type: "POST",
                    url: "<?php echo site_url('data/akses_menu/delete_permanent') ?>",
                    timeout: 20000,
                    data:
                    'datamodel=' + $(index).attr("datamodel")

                    , success: function(result) {
                    //alert(result);
                    if (result == "1")
                    {
                    alertify.success('Hapus sukses');
                            location.reload();
                            /* window.location.replace("<?php echo site_url('data/role/'); ?>"); */
                    }
                    else if (result == "2")
                    {
                    alertify.error('Data Tidak Dapat Dihapus');
                    }
                    else
                    {
                    alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
                    }
                    $('.loading_gear_gif').hide();
                    },
                    error: function(html) {
                    alertify.error("Kode Eror [" + html.status + "]<br/><br/>Status:" + html.statusText);
                            $('.loading_gear_gif').hide();
                    }

            });
            } else {
            alertify.error("Anda batal menghapus data");
                    $('.loading_gear_gif').hide();
            }
            });
                    //}
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

            var app = angular.module('main', ['ngTable', 'ngTableExport', 'picardy.fontawesome']).
                    controller('DemoCtrl', function($scope, $filter, $http, NgTableParams, $sce) {
                    var data = [];
                            $http.get('<?php echo site_url('data/akses_menu/akses_menu_show'); ?>')
                            .success(function($role) {
                            // alert(vardump($role))
                            data = $role;
                                    $scope.tableParams = new NgTableParams({
                                    page: 1, // show first page
                                            count: 100, // count per page
                                            filter: {
                                            role_nsms: '', // initial filter
                                            },
                                            sorting: {
                                            role_nsms: 'asc'     // initial sorting
                                            }

                                    }, {
                                            allowUnsort: true,
                                            data: data,
                                    });
                                    $('.loading_gif').hide();
                            });
                            //
                            $scope.show = function (index) { //kalau ada parameter dimasukkan ke dalam function ()
                            $('.action_bar_' + index).toolbar({
                            content: '#toolbar-options-' + index,
                                    position: 'top',
                                    style:'warning',
                                    adjustment: 7
                            });
                            };
                    });        </script>
    </head>
    <body ng-app="main">

        <div class="col-md-12">
            <br/>
            <div ng-controller="DemoCtrl">
                <div class="row" >
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-3 " >

                    </div>
                    <div class="col-md-2"">
                        <!--<a class="btn btn-primary pull-right" ng-mousedown="csv.generate()" ng-href="{{ csv.link()}}" download="role.csv">Export to CSV</a>-->
                        <input class="form-control" type="search" id="filter_search" ng-model="user.user_name" placeholder="Cari Hak Akses..." aria-label="filter role" />
                    </div>
                    <div class="col-md-2">	
                        <button ng-click="tableParams.sorting({})" onclick="clear_sorting()" class="btn btn-default btn-w100">Clear Sorting</button>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table ng-table="tableParams"  class="table ng-table-responsive latar" export-csv="csv">
                            <tr ng-repeat="(datamodel, user) in $data | filter:user.user_name as results"  ng-class-odd="'Bg_genap'" ng-class-even="'Bg_ganjil'"  ng-class="{ 'emphasis': user.user_name == '<?php echo $this->session->userdata("user_name") ?>'}">                                 
                                <td align="center" style="width:1%" class=" borderkanan" data-title="'No'">
                                    <span>{{$index + 1}}</span>
                                </td> 										
                                <td class="col-md-9 borderkanan" data-title="'Role'" sortable="'role_nama'">
                                    <span id="user_name_{{$index}}" >{{user.role_nama}}</span>
                                </td> 

                                <td class="col-md-3 action" data-title="'Access'"  ng-mouseover="show($index)" >
                            <center>
                                <fa class="fa-main btn-toolbar btn-toolbar-warning action_bar_{{$index}}" name="gear" size="2"></fa>
                                <div id="toolbar-options-{{$index}}" class="hidden">
                                    <a  title="Ubah Data" href="" id="user-{{$index}}" datamodel={{user.datamodel}} onclick="form_edit(this)">
                                        <fa name="edit" size="2"></fa></a>
                                </div>    
                            </center>
                            <a style="display:none;" >
                                <span >{{user.datamodel}}</span>
                            </a>
                            </td>


                            </tr> 
                            <tr ng-if="results.length == 0">
                                <td colspan="2">
                            <center> <strong>Data tidak ditemukan...</strong></center>
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

        <?php $this->load->view("data/akses_menu_crud_view"); // remodal  ?>

        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script> 		
    </body>
</html>