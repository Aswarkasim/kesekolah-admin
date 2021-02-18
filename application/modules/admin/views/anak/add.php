<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $title ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
                echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
                ?>

                <form action="<?= base_url($add) ?>" method="post">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Nama Anak</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="nama_anak" placeholder="Nama Anak" value="<?= set_value('nama_anak') ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Umur</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="umur" placeholder="Umur" value="<?= set_value('umur') ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Anak Dari</label>
                            </div>
                            <div class="col-md-9">
                                <select name="id_user" class="form-control select2">
                                    <option value="none">-- Orang Tua --</option>
                                    <?php foreach ($user as $row) { ?>
                                        <option value="<?= $row->id_user; ?>"><?= $row->namalengkap  . ' - Alamat : ' . $row->alamat; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Sekolah di</label>
                            </div>
                            <div class="col-md-9">
                                <select name="id_sekolah" class="form-control select2">
                                    <option value="none">-- Sekolah --</option>
                                    <?php foreach ($sekolah as $row) { ?>
                                        <option value="<?= $row->id_sekolah; ?>"><?= $row->nama_sekolah ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Driver</label>
                            </div>
                            <div class="col-md-9">
                                <select name="id_driver" class="form-control select2">
                                    <option value="none">-- Driver --</option>
                                    <?php foreach ($driver as $row) { ?>
                                        <option value="<?= $row->id_user; ?>"><?= $row->namalengkap ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-9">
                                <a href="<?= base_url($back) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>

                </form>



            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>