window.Vue = require('vue');
import PhPairList from './components/phPairList.vue';
import GhPairList from './components/ghPairList.vue';
import GhCard from './components/ghCard.vue';
import PhCard from './components/phCard.vue';
import PhModal from './components/PhModal.vue';

const vapp = new Vue({
    el: '#app',
    components: {PhPairList,GhPairList,GhCard,PhCard},
    data:{
    	phPairs: IndexBase.data.phPairs,
    	ghPairs: IndexBase.data.ghPairs,
    	ghs: IndexBase.data.ghs,
    	phs: IndexBase.data.phs,
        phMax: IndexBase.data.phLimit.value,
        ghButton: {
          text:'Get Help',
          status:false,
      },
      phButton: {
          text:'Provide Help',
          status:false,
      },
      showPhPairs:true,
      showGhPairs:true,
      showPhs:true,
      showGhs:true,
  },
  methods:{

     togglePhPairs(){
      this.showPhPairs = !this.showPhPairs;
  },
  toggleGhPairs(){
      this.showGhPairs = !this.showGhPairs;
  },
  togglePhs(){
      this.showPhs = !this.showPhs;
  },
  toggleGhs(){
      this.showGhs = !this.showGhs;
  },
  startPhProcess(){
    this.showModal = true;
},
startGhProcess(){
},
canProvideHelp(){
  var former = this.phButton.text;
  this.phButton.status = true;
  this.phButton.text = '<i class="fa fa-circle-o-notch fa-spin"></i>';
  $.getJSON('/json/phs/create',  (r) => {
    if (r.status == 'allowed') {
     this.startPhProcess();
 }
 else if(r.error =='unauthenticated'){
    swal('Failed','Your Session has Expired','error');
}
else{
 swal('success',r.messages[0],'error');
}
})
  .always(()=> {this.phButton.text = 'Provide Help';this.phButton.status = false;});
},
canGetHelp(){
  var former = this.ghButton.text;
  this.ghButton.status = true;
  this.ghButton.text = '<i class="fa fa-circle-o-notch fa-spin"></i>';
  $.getJSON('/json/ghs/create',  (r) => {
    if (r.status == 'allowed') {
     this.startGhProcess();
 }
 else if(r.error =='unauthenticated'){
    swal('Failed','Your Session has Expired','error');
}
else{
 swal('Failed',r.message,'error');
}
})
  .always(()=> {this.ghButton.text = 'Get Help';this.ghButton.status = false;});
},
swallow(e){
    var vm = this;
    var form = e.target;
    swal({
        title: 'Confirm',
        type: 'info',
        html: 'Are you sure you want to provide help of &#8358;'+$(form).find('#form-amount').val()+'?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                $.post('/json/phs', $(form).serialize(), function(data, textStatus, xhr) {
                    console.log(data);
                },'json')
                .done(function(r){
                    if(r.status == 'success'){
                        resolve(r);
                        vm.phs.unshift(r.ph);
                    }
                    else if(r.status == 'failed'){
                        reject(r.message);
                    }
                })
                .fail(function(){
                    reject('Your Request to provide help failed. Please try again later');    
                });
            });
        },
        allowOutsideClick: false
    }).then(function (d) {
        swal({
            type: 'success',
            title: 'Congrats',
            html: 'Your request to provide help has been logged. Once a suitable match is found, you will be notified to provide help',
        })
    },
    function (d) {
        swal({
            type: 'error',
            title: 'Congrats',
            html: d,
        })
    })
}

},
created(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : IndexBase.csrf,
        },
        data: {
            _token: IndexBase.csrf,
        },
        error: function(xhr, status, error){
            if (xhr.status == 401) {
                swal('Session Expired', 'Your session has expired and you have been logged out.','error');
            }
        }
    });

}
});