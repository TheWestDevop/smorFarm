<template>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->

      <router-link :to="{name:'home'}" class="navbar-brand pt-0">
        <div class="h1 text-blue navbar-brand-img">
            <strong class=" font-italic">SMOR</strong>
            Farm
        </div>
      </router-link>

      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">

                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <i class="ni ni-bell-55"></i><sup v-if="executor.notify.count != 0" class="badge bg-white text-blue">{{executor.notify.count}}</sup>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                                <a class="dropdown-item text-success" href="#" v-for="(notification,n) in executor.notify.notification" :key="n.index">New {{notification.user_type}} Order with Total Price {{notification.total}} and Ticket ID  {{notification.ticket_id}} <br> <small class="text-gray float-right m-2">{{notification.created_at}} </small></a>
                            </div>

                        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">

              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="/img/theme/team-1-800x800.jpg">
              </span>
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
            <a  href="/executor/logout"  class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="#">
                <div class="h3 text-blue navbar-brand-img">
                    <strong class=" font-italic">SMOR</strong>
                    Farm
                </div>
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">

          <li class="nav-item">
            <router-link :to="{name:'home'}" class="nav-link ">
              <i class="ni ni-cart text-red"></i> Orders
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name:'location'}" class="nav-link ">
              <i class="fa fa-location-arrow text-blue"></i> Location
            </router-link>
          </li>
        </ul>


      </div>
    </div>
  </nav>
</template>

<script>

import {
    get
} from '../util/api'
export default {
  name:'side_nav',
  props: ["executor"],
  methods:{

  }
}
</script>

<style>

</style>
