<?php

$id_user = $this->session->userdata('id_user');
$role = $this->session->userdata('role');

?>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>

            <li class="<?php if ($this->uri->segment(2) == "dashboard") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/dashboard')
                                        ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <li class="<?php if ($this->uri->segment(2) == "anak") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/anak')
                                        ?>"><i class="fa fa-child"></i> <span>Anak</span></a></li>

            <li class="<?php if ($this->uri->segment(2) == "sekolah") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/sekolah')
                                        ?>"><i class="fa fa-building"></i> <span>Sekolah</span></a></li>

            <!-- <li class="<?php if ($this->uri->segment(2) == "payment") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo base_url('admin/payment')
                                        ?>"><i class="fa fa-money"></i> <span>Payment</span></a></li> -->








            <li class="treeview <?php if ($this->uri->segment(2) == "user") {
                                    echo "active";
                                } ?>">
                <a href="#"><i class="fa fa-user"></i> <span>Manajemen User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($this->uri->segment(3) == "index") {
                                    echo "active";
                                } ?>"><a href="<?= base_url('admin/user/index') ?>">User</a></li>
                    <li class="<?php if ($this->uri->segment(3) == "driver") {
                                    echo "active";
                                } ?>"><a href="<?= base_url('admin/user/driver') ?>">Driver</a></li>
                </ul>
            </li>

            <li class="<?php if ($this->uri->segment(2) == "admin") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/admin')
                                        ?>"><i class="fa fa-user-secret"></i> <span>Admin</span></a></li>

            <li class="<?php if ($this->uri->segment(2) == "konfigurasi") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/konfigurasi')
                                        ?>"><i class="fa fa-cogs"></i> <span>Konfigurasi</span></a></li>


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">