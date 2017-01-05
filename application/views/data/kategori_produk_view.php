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
                    site_url = '<?php echo site_url(); ?>/data/kategori_produk/';
                    base_url = '<?php echo base_url(); ?>/';
                    window.onload = function() {

                    $('.loading_gear_gif').show();
                            if (error != "")
                    {
                    if (ubah != '')
                    {
                    $('#button').attr("name", "ubah");
                            $('#button').attr("value", "Ubah");
                            $('#form_kategori_produk').attr("action", site_url + 'edit');
                    }

                    show_remodal();
                    }

                    if (_alert != "")
                            alertify.success(_alert);
                    }

            function form_insert(){
            // if (_insert != '0')
                    show_remodal();
                    // else{
                    // setTimeout(function()
                    // {
                    // $('.loading_gear_gif').hide();
                    // }, 800);
                            // alertify.error("Anda tidak mempunyai akses untuk insert!");
                    // }
            }

            function form_edit(index)
            {
            // if (_edit != '0'){
            $('.loading_gear_gif').show();
                    $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('data/kategori_produk/kategori_produk_show_by_id') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + $(index).attr("datamodel")

                            , success: function(result) {
                            // alert(result);
                            if (result != "[]")
                            {
                            var arr = JSON.parse(result);
                                    $('#kategori_produk_nama').val(arr[0].kategori_produk_nama);
                                    $('#kategori_produk_keterangan').val(arr[0].kategori_produk_keterangan);
                                    $('#datamodel').val(arr[0].datamodel);
                                    $('#button').attr("name", "ubah");
                                    $('#button').attr("value", "Ubah");
                                    $('#form_kategori_produk').attr("action", site_url + 'edit');
                                    show_remodal();
                                    $('#kategori_produk_nama').focus();
                            }
                            else
                                    alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
                                    //	$('.loading_gif').hide();
                            }

                    });
            // } else{
            // alertify.error("Anda tidak mempunyai akses untuk edit!");
            // }
            }


            function deleted(index)
            {
            // if (_delete != '0'){

            confirm("Apakah anda yakin akan menghapus data ini ?", function(e) {
            if (e) {
            $('.loading_gear_gif').show();
                    $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('data/kategori_produk/delete') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + $(index).attr("datamodel")

                            , success: function(result) {
                            if (result == "1")
                            {
                            alertify.success('Hapus sukses');
                                    location.reload();
                                    window.location.replace("<?php echo site_url('data/kategori_produk/'); ?>");
                            }
                            else if (result == "2")
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
            alertify.error("Anda batal menghapus data kategori_produk");
                    $('.loading_gear_gif').hide();
            }
            });
            // } else{
            // alertify.error("Anda tidak mempunyai akses untuk hapus!");
            // }
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
                            $http.get('<?php echo site_url('data/kategori_produk/kategori_produk_show'); ?>')
                            .success(function($kategori_produk) {
                            data = $kategori_produk;
                                    $scope.tableParams = new NgTableParams({
                                    page: 1, // show first page
                                            count: 100, // count per page
                                            filter: {
                                            kategori_produk_nama: '', // initial filter
                                            },
                                            sorting: {
                                            kategori_produk_nama: 'asc'    // initial sorting
                                            }

                                    }, {
                                    allowUnsort: true,
                                            data: data,
                                    });
                                    $('.loading_gear_gif').hide();
                            });
                            //
                            $scope.show = function (index) { //kalau ada parameter dimasukkan ke dalam function ()
                            $('.action_bar_' + index).toolbar({
                            content: '#toolbar-options-' + index,
                                    position: 'top',
                                    style:'primary',
                                    adjustment: 7
                            });
                            };
                    });</script>
    </head>
    <body ng-app="main">
        <div class="container-fluid">

            <div ng-controller="DemoCtrl">
                <div class="row" >
                    <div class="col-md-7">
                        <button type="submit" onclick="form_insert()" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Tambah Data</button>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="search" id="filter_search" ng-model="kategori_produk.kategori_produk_nama" placeholder="Cari kategori produk..." aria-label="Cari kategori_produk" />
                    </div>
                    <div class="col-md-2">
                        <button ng-click="tableParams.sorting({})" onclick="clear_sorting()" class="btn btn-default btn-w100">Clear Sorting</button>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12">
                        <table ng-table="tableParams"  class="table ng-table-responsive latar" export-csv="csv">
                            <tr ng-repeat="(datamodel, kategori_produk) in $data | filter:kategori_produk.kategori_produk_nama as results"  ng-class-odd="'Bg_genap'" ng-class-even="'Bg_ganjil'"   ng-class-odd="'Bg_genap'" ng-class-even="'Bg_ganjil'"  ng-class="{ 'emphasis': kategori_produk.kategori_produk_nama == '<?php echo $this->session->userdata("kategori_produk_nama") ?>'}">
                                <td align="center" style="width:1%" class=" borderkanan" data-title="'No'">
                                    <span>{{$index + 1}}</span>
                                </td> 
                                <td class="col-md-5 borderkanan" data-title="'Kategori Nama'" sortable="'kategori_produk_nama'">
                                    <span id="kategori_produk_nama_{{$index}}" >{{kategori_produk.kategori_produk_nama}}</span>
                                </td> 
                                <td class="col-md-5" data-title="'Keterangan'" sortable="'kategori_produk_keterangan'"> 
                                    <span id="kategori_produk_keterangan{{$index}}" >{{kategori_produk.kategori_produk_keterangan}}</span>  
                                </td>

                                <td class="action" data-title="'Actions'" ng-mouseover="show($index)" >
                            <center>

                                <fa  ng-if="kategori_produk.is_permanent == 0" class="fa-main btn-toolbar btn-toolbar-primary action_bar_{{$index}}" name="gear" size="2"></fa>
                                <div id="toolbar-options-{{$index}}" class="hidden" >

                                    <a title="Ubah Data" href="" id="kategori_produk-{{$index}}" datamodel={{kategori_produk.datamodel}} ng-if="kategori_produk.is_permanent == 0" onclick="form_edit(this)">
                                        <fa name="edit" size="2"></fa></a>
                                    <a title="Hapus Data" href="" id="kategori_produk-{{$index}}" datamodel={{kategori_produk.datamodel}} ng-if="kategori_produk.is_permanent == 0"  onclick="deleted(this)">
                                        <fa name="remove" size="2"></fa></a>
                                </div>
                            </center>
                            </td>

                            <a style="display:none" >
                                <span >{{kategori_produk.datamodel}}</span>
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
        <?php $this->load->view("data/kategori_produk_crud_view"); // remodal  ?>

        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script> 
    </body>
</html>