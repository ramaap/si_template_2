<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 

        <?php $this->load->view('common/head_front'); ?>
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
                    site_url = '<?php echo site_url(); ?>/front/cart/';
                    base_url = '<?php echo base_url(); ?>/';
                    window.onload = function() {

                    $('.loading_gear_gif').show();
                            if (error != "")
                    {
                    if (ubah != '')
                    {
                    $('#button').attr("name", "ubah");
                            $('#button').attr("value", "Ubah");
                            $('#form_cart').attr("action", site_url + 'edit');
                    }

                    show_remodal();
                    }

                    if (_alert != "")
                            alertify.success(_alert);
                    }

            function form_insert(){
                    show_remodal();
            }

            function form_edit(index)
            {
            $('.loading_gear_gif').show();
                    $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('front/cart/cart_show_by_id') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + $(index).attr("datamodel")

                            , success: function(result) {
                            // alert(result);
                            if (result != "[]")
                            {
                            var arr = JSON.parse(result);
                                    $('#cart_nama').val(arr[0].cart_nama);
                                    $('#cart_keterangan').val(arr[0].cart_keterangan);
                                    $('#datamodel').val(arr[0].datamodel);
                                    $('#button').attr("name", "ubah");
                                    $('#button').attr("value", "Ubah");
                                    $('#form_cart').attr("action", site_url + 'edit');
                                    show_remodal();
                                    $('#cart_nama').focus();
                            }
                            else
                                    alertify.error("Kode Eror [100] : Terjadi kesalahan saat eksekusi permintaan<br/><br/>Status: gagal menerima data dari server");
                                    //	$('.loading_gif').hide();
                            }

                    });
            }


            function deleted(index)
            {
                    $.ajax({
                    type: "POST",
                            url: "<?php echo site_url('front/cart/delete') ?>",
                            timeout: 20000,
                            data:
                            'datamodel=' + $(index).attr("datamodel")

                            , success: function(result) {
                            if (result == "1")
                            {
                            alertify.success('Hapus sukses');
                                    location.reload();
                                    window.location.replace("<?php echo site_url('front/cart/'); ?>");
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
                            $http.get('<?php echo site_url('front/cart/cart_show'); ?>')
                            .success(function($cart) {
                            data = $cart;
                                    $scope.tableParams = new NgTableParams({
                                    page: 1, // show first page
                                            count: 100, // count per page
                                            filter: {
                                            cart_nama: '', // initial filter
                                            },
                                            sorting: {
                                            cart_nama: 'asc'    // initial sorting
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
			</br>
			<a class="menu" href="<?php echo site_url('login_customer/logout') ?>" >Logout</a>
                <div class="row" >
                    <div class="col-md-6">
                        <table ng-table="tableParams"  class="table ng-table-responsive latar" export-csv="csv">
                            <tr ng-repeat="(datamodel, cart) in $data | filter:cart.cart_nama as results"  ng-class-odd="'Bg_genap'" ng-class-even="'Bg_ganjil'"   ng-class-odd="'Bg_genap'" ng-class-even="'Bg_ganjil'"  ng-class="{ 'emphasis': cart.cart_nama == '<?php echo $this->session->userdata("cart_nama") ?>'}">
                                <td align="center" style="width:1%" class=" borderkanan" data-title="'No'">
                                    <span>{{$index + 1}}</span>
                                </td> 
                                <td class="col-md-5 borderkanan" data-title="'Kategori Nama'" sortable="'cart_nama'">
                                    <span id="cart_nama_{{$index}}" >{{cart.cart_nama}}</span>
                                </td> 
                                <td class="col-md-5" data-title="'Keterangan'" sortable="'cart_keterangan'"> 
                                    <span id="cart_keterangan{{$index}}" >{{cart.cart_keterangan}}</span>  
                                </td>

                                <td class="action" data-title="'Actions'" ng-mouseover="show($index)" >
                            <center>
                                    <!--a title="Ubah Data" href="" id="cart-{{$index}}" datamodel={{cart.datamodel}} ng-if="cart.is_permanent == 0" onclick="form_edit(this)">
                                        <fa name="edit" size="2"></fa></a-->
                                    <a title="Hapus Data" href="" id="cart-{{$index}}" datamodel={{cart.datamodel}} ng-if="cart.is_permanent == 0"  onclick="deleted(this)">
                                        <fa name="remove" size="2"></fa></a>
                            </center>
                            </td>

                            <a style="display:none" >
                                <span >{{cart.datamodel}}</span>
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

        <script src="<?php echo base_url(); ?>include/js/bootstrap.min.js"></script> 
    </body>
</html>