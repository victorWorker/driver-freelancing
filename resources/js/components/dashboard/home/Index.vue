<template>
   <div class="content-wrapper">
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
              <div class="col-12">
                <div class="page-header">
                  <h4 class="page-title">Dashboard</h4>
                  <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                    <ul class="quick-links">
                      <li><a href="#">ICE Market data {{total_bids}}</a></li>
                      <li><a href="#">Own analysis</a></li>
                      <li><a href="#">Historic market data</a></li>
                    </ul>
                    <ul class="quick-links ml-auto">
                      <li><a href="#">Settings</a></li>
                      <li><a href="#">Analytics</a></li>
                      <li><a href="#">Watchlist</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="page-header-toolbar">
                  <div class="btn-group toolbar-item" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary"><i class="mdi mdi-chevron-left"></i></button>
                    <button type="button" class="btn btn-secondary">03/02/2019 - 20/08/2019</button>
                    <button type="button" class="btn btn-secondary"><i class="mdi mdi-chevron-right"></i></button>
                  </div>
                  <div class="filter-wrapper">
                    <div class="dropdown toolbar-item">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownsorting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Day</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownsorting">
                        <a class="dropdown-item" href="#">Last Day</a>
                        <a class="dropdown-item" href="#">Last Month</a>
                        <a class="dropdown-item" href="#">Last Year</a>
                      </div>
                    </div>
                    <a href="#" class="advanced-link toolbar-item">Advanced Options</a>
                  </div>
                  <div class="sort-wrapper">
                    <button type="button" class="btn btn-primary toolbar-item">New</button>
                    <div class="dropdown ml-lg-auto ml-3 toolbar-item">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownexport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownexport">
                        <a class="dropdown-item" href="#">Export as PDF</a>
                        <a class="dropdown-item" href="#">Export as DOCX</a>
                        <a class="dropdown-item" href="#">Export as CDR</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page Title Header Ends-->
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row"> 

                      <div class="col-md-3 mt-4 mt-md-0">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-success mr-2"></div> 
                          <p class="mb-0">Total Jobs</p>
                        </div> 
                        <h4 class="font-weight-semibold">{{all_data.total_jobs}}</h4>
                        <div class="progress progress-md">
                          <div role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45" class="progress-bar bg-success" style="width: 45%;"></div>
                        </div>
                      </div>

                      <div class="col-md-3 mt-4 mt-md-0">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-info mr-2"></div> 
                          <p class="mb-0">Awarded</p>
                        </div> 
                        <h4 class="font-weight-semibold">{{all_data.awarded_jobs}}</h4>
                        <div class="progress progress-md">
                          <div role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45" class="progress-bar bg-info" style="width: 45%;"></div>
                        </div>
                      </div>

                      <div class="col-md-2 mt-4 mt-md-0">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-warning mr-2"></div> 
                          <p class="mb-0">Incompleted</p>
                        </div> 
                        <h4 class="font-weight-semibold">{{all_data.incomplete_jobs}}</h4>
                        <div class="progress progress-md">
                          <div role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45" class="progress-bar bg-warning" style="width: 45%;"></div>
                        </div>
                      </div>

                      <div class="col-md-2 mt-4 mt-md-0">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-success mr-2"></div> 
                          <p class="mb-0">Completed</p>
                        </div> 
                        <h4 class="font-weight-semibold">{{all_data.completed_jobs}}</h4>
                        <div class="progress progress-md">
                          <div role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45" class="progress-bar bg-success" style="width: 45%;"></div>
                        </div>
                      </div>

                      <div class="col-md-2 mt-4 mt-md-0">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div> 
                          <p class="mb-0">Expired</p>
                        </div> 
                        <h4 class="font-weight-semibold">{{all_data.expired_jobs}}</h4>
                        <div class="progress progress-md">
                          <div role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45" class="progress-bar bg-danger" style="width: 45%;"></div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 grid-margin stretch-card average-price-card">
                <div class="card text-white bg-success">
                  <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 align-items-center">
                      <h2 class="font-weight-semibold mb-0">{{all_data.total_approveuser}}</h2>
                      <div class="icon-holder bg-success">
                        <i class="mdi mdi-briefcase-outline"></i>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between">
                    <h5 class="font-weight-semibold mb-0">Approved user</h5>
                     <p class="text-white mb-0"> </p>
                    </div>
                 </div>
               </div>
             </div>

             <div class="col-md-3 grid-margin stretch-card average-price-card">
                <div class="card text-white bg-danger">
                  <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 align-items-center">
                      <h2 class="font-weight-semibold mb-0">{{all_data.total_unapproveuser}}</h2>
                      <div class="icon-holder bg-danger">
                        <i class="mdi mdi-briefcase-outline"></i>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between">
                    <h5 class="font-weight-semibold mb-0">Unapproved user</h5>
                     <p class="text-white mb-0"> </p>
                    </div>
                 </div>
               </div>
             </div>
             
               <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="d-flex align-items-center pb-2">
                              <div class="dot-indicator bg-danger mr-2"></div>
                              <p class="mb-0">Total Clients</p>
                            </div>
                            <h4 class="font-weight-semibold">{{all_data.total_client}}</h4>
                            <div class="progress progress-md">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                            </div>
                          </div>
                          <div class="col-md-6 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2">
                              <div class="dot-indicator bg-success mr-2"></div>
                              <p class="mb-0">Total Transporters</p>
                            </div>
                            <h4 class="font-weight-semibold">{{all_data.total_drivers}}</h4>
                            <div class="progress progress-md">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-6">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">{{all_data.incomplete_bids}}</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Incomplete bids</h5>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">{{all_data.awarded_bids}}</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Awarded bids</h5>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">{{all_data.expired_bids}}</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Expired bids</h5>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">{{all_data.completed_bids}}</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Completed bids</h5>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-12 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <h4 class="card-title mb-0">Transaction</h4>
                          <a href="dash/transactions"><small>Show All</small></a>
                        </div>
                        <div class="table-responsive table-res-contain">
                          <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th>Transaction ID</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="(trans, index) in all_data.transaction" :key="index">
                                <td>{{trans.id}}</td>
                                <td>{{trans.user.name}}</td>
                                <td>{{trans.status}}</td>
                                <td>{{trans.type}}</td>
                                <td>{{trans.amount}}</td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-12 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title mb-0">Top Performer</h4>
                        <div class="d-flex mt-3 py-2 border-bottom">
                          <img class="img-sm rounded-circle" :src="`${baseURL}assets/images/faces/face3.jpg`" alt="profile image">
                          <div class="wrapper ml-2">
                            <p class="mb-n1 font-weight-semibold">Ray Douglas</p>
                            <small>162543</small>
                          </div>
                          <small class="text-muted ml-auto">1 Hours ago</small>
                        </div>
                        <div class="d-flex py-2 border-bottom">
                          <span class="img-sm rounded-circle bg-warning text-white text-avatar">OH</span>
                          <div class="wrapper ml-2">
                            <p class="mb-n1 font-weight-semibold">Ora Hill</p>
                            <small>162543</small>
                          </div>
                          <small class="text-muted ml-auto">4 Hours ago</small>
                        </div>
                        <div class="d-flex py-2 border-bottom">
                          <img class="img-sm rounded-circle" :src="`${baseURL}assets/images/faces/face4.jpg`" alt="profile image">
                          <div class="wrapper ml-2">
                            <p class="mb-n1 font-weight-semibold">Brian Dean</p>
                            <small>162543</small>
                          </div>
                          <small class="text-muted ml-auto">4 Hours ago</small>
                        </div>
                        <div class="d-flex pt-2">
                          <span class="img-sm rounded-circle bg-success text-white text-avatar">OB</span>
                          <div class="wrapper ml-2">
                            <p class="mb-n1 font-weight-semibold">Olive Bridges</p>
                            <small>162543</small>
                          </div>
                          <small class="text-muted ml-auto">7 Hours ago</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
</template>

<script>
import moment from 'moment';
import {mapActions, mapGetters} from 'vuex';
export default {
    data() {
        return {
            moment,
            baseURL,
            total_bids:'',
            all_data:{},
        }
    },
    mounted(){
        this.init();
    },
    methods:{
        async init() {
                axios.get('/admin/dash/count')
                     .then((response)=>{
                        this.all_data=response.data;
                })

        },
    },
}
</script>

<style>

</style>