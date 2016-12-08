<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 

        <?php $this->load->view('common/head'); ?>
        <?php
        $ubah = (isset($ubah)) ? $ubah : '';
        $alert = $this->session->userdata("error");
        $this->session->unset_userdata("error");
        ?>
        <?php $this->load->view('common/menu'); ?>
        <script type="text/javascript">
            error = '<?php echo $error; ?>';
                    ubah = '<?php echo $ubah; ?>';
                    _alert = '<?php echo $alert; ?>';
                    _insert = '<?php echo $this->session->userdata('akses_insert'); ?>';
                    _edit = '<?php echo $this->session->userdata('akses_edit'); ?>';
                    _delete = '<?php echo $this->session->userdata('akses_delete'); ?>';
                    site_url = '<?php echo site_url(); ?>/data/users/';
                    base_url = '<?php echo base_url(); ?>/';
                    window.onload = function() {
                    $('.loading_gear_gif').show();
                            $('#div_role_baru').hide();
                            if (error != "")
                    {
                    if (ubah != '')
                    {
                    $('#button').attr("name", "ubah");
                            $('#button').attr("value", "Ubah");
                            $('#form_user').attr("action", site_url + 'edit');
                    }
                    show_remodal();
                            init_chosen();
                    }

                    if (_alert != "")
                            alertify.success(_alert);
                    }

            function form_insert(){
            $('.loading_gear_gif').show();
                    if (_insert != '0')
            {
            show_remodal();
                    init_chosen();
            }

            else{
            alertify.error("Anda tidak mempunyai akses untuk insert!");
            }

            setTimeout(function()
            {
            $('.loading_gear_gif').hide();
            }, 800);
            }

            function form_edit(index)
            {
            if (_edit != '0'){
            $('.loading_gear_gif').show();
                    $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('data/users/user_show_by_id') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + $(index).attr("datamodel")

                            , success: function(result) {
                            // alert(result);
                            if (result != "[]")
                            {
                            var arr = JSON.parse(result);
                                    $('#div_user_password').hide();
                                    $('#role_id').val(arr[0].role_id);
                                    $('#user_name').val(arr[0].user_name);
                                    init_chosen();
                                    $('#datamodel').val(arr[0].datamodel);
                                    $('#button').attr("name", "ubah");
                                    $('#button').attr("value", "Ubah");
                                    $('#form_user').attr("action", site_url + 'edit');
                                    show_remodal();
                            }
                            else
                                    alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
                                    //	$('.loading_gif').hide();
                            }

                    });
            } else{
            alertify.error("Anda tidak mempunyai akses untuk edit!");
            }
            }

            function deleted(index)
            {
            if (_delete != '0'){
            confirm("Apakah anda yakin akan menghapus data ini ?", function(e) {
            if (e) {
            var value = prompt("Ubah harus melalui Otorisasi Manager !\nMasukkan Password : ");
                    $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('data/users/delete') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + $(index).attr("datamodel") +
                            '&input_pass=' + value

                            , success: function(result) {
                            if (result == "0")
                            {
                            alertify.error('hapus gagal');
                            }
                            if (result == "1")
                            {
                            alertify.success('Hapus sukses');
                                    location.reload();
                                    window.location.replace("<?php echo site_url('data/users/'); ?>");
                            }
                            else if (result == "2")
                            {
                            alertify.error('Data Tidak Dapat Dihapus');
                            }
                            else if (result == "3")
                            {
                            alertify.error('Otorisasi ditolak');
                            }
                            else
                                    alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server      " + result);
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
            } else{
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

            var app = angular.module('main', ['ngTable', 'ngTableExport', 'picardy.fontawesome']).
                    controller('DemoCtrl', function($scope, $filter, $http, NgTableParams, $sce) {
                    var data = [];
                            $http.get('<?php echo site_url('data/users/user_show'); ?>')
                            .success(function($user) {
                            data = $user;
                                    $scope.tableParams = new NgTableParams({
                                    page: 1, // show first page
                                            count: 100, // count per page
                                            filter: {
                                            user_name: '', // initial filter
                                            },
                                            sorting: {
                                            user_name: 'asc'    // initial sorting
                                            }

                                    }, {
                                    allowUnsort: true,
                                            data: data,
                                    });
                                    $('.loading_gear_gif').hide();
                            }); //
                            $scope.show = function (index) { //kalau ada parameter dimasukkan ke dalam function ()
                            $('.action_bar_' + index).toolbar({
                            content: '#toolbar-options-' + index,
                                    position: 'top',
                                    style:'black',
                                    adjustment: 7
                            });
                            };
                    });
                    function cek_baru()
                    {
                    $('#div_role_baru').hide();
                            if ($("#role_id").val() == "xxxxx")
                    {
                    $('#div_role_baru').show();
                    }
                    }
        </script>
    </head>
    <body ng-app="main">
        <div class="container-fluid">

            <div ng-controller="DemoCtrl">
                <div class="row" >
                    <div class="col-md-7">
                        <button type="submit" onclick="form_insert()" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Tambah Data</button>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="search" id="filter_search" ng-model="user.user_name" placeholder="Cari User..." aria-label="Cari User" />
                    </div>
                    <div class="col-md-2">
                        <button ng-click="tableParams.sorting({})" onclick="clear_sorting()" class="btn btn-default btn-w100">Clear Sorting</button>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table ng-table="tableParams"  class="table ng-table-responsive latar" export-csv="csv">
                            <tr ng-repeat="(datamodel, user) in $data | filter:user.user_name as results"  ng-class-odd="'Bg_genap'" ng-class-even="'Bg_ganjil'"  ng-class="{ 'emphasis': user.role_nama == '<?php echo $this->session->userdata("role_nama") ?>'}">
                                <td align="center" style="width:1%" class=" borderkanan" data-title="'No'">
                                    <span>{{$index + 1}}</span>
                                </td> 
                                <td class="username" data-title="'Username'" sortable="'user_name'">
                                    <span id="user_name_{{$index}}" >{{user.user_name}}</span>
                                </td> 
                                <td class="role" data-title="'Role'" sortable="'role_nama'"> 
                                    <span id="role_nama_{{$index}}" >{{user.role_nama}}</span>  
                                </td> 

                                <td class="action" data-title="'Actions'" ng-mouseover="show($index)">
                            <center>
                                <fa ng-if="user.is_permanent == 0" class="fa-main btn-toolbar btn-toolbar-black action_bar_{{$index}}" name="gear" size="2"></fa>
                                <div id="toolbar-options-{{$index}}" class="hidden" >

                                    <a title="Ubah Data" href="" id="user-{{$index}}" datamodel={{user.datamodel}} ng-if="user.is_permanent == 0" onclick="form_edit(this)">
                                        <fa name="edit" size="2"></fa></a>
                                    <a title="Hapus Data" href="" id="user-{{$index}}" datamodel={{user.datamodel}}  ng-if="user.is_permanent == 0" onclick="deleted(this)">
                                        <fa name="remove" size="2"></fa></a>
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

        <?php $this->load->view('common/footer'); ?>
        <?php $this->load->view("data/user_crud_view"); // remodal  ?>

        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script> 
    </body>
</html>