<template>
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
                <div class="container-fluid">
                    <!-- Form -->
                    <div class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                        <div class="form-group mb-0">
                            <div class="">

                               </div>
                        </div>
                    </div>
                    <!-- User -->
                    <ul class="navbar-nav align-items-center d-none d-md-flex">
                        <li class="nav-item dropdown">

                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <i class="ni ni-bell-55"></i><sup v-if="nav.notify.count != 0" class="badge bg-white text-blue">{{nav.notify.count}}</sup>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                                <a class="dropdown-item text-success" href="#" v-for="(notification,n) in nav.notify.notification" :key="n.index">New {{notification.user_type}} Order with Total Price {{notification.total}} And Ticket ID {{notification.ticket_id}} <br> <small class="text-gray float-right m-2">{{notification.created_at}} </small></a>
                            </div>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="/img/theme/team-4-800x800.jpg">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">Admin</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <a href="#" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>My profile</span>
                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="/admin/logout" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
</template>

<script>
export default {
    name:'navbar',
    props:['nav'],
     data(){
  return {

  }
 },
 created(){

 },


}
</script>

