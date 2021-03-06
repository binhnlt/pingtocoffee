<template>
  <div class="sidebar relative pa3 bg-white mb-3 br2">
    <div class="db mb2">
      <h6 class="light-gray-text dib fw6">{{ __('user.requests_sent_title') }}</h6>
      <a v-if="enableSeeAll" href="/contacts/requests?outgoing=1" class="dib fr">{{ __('user.see_all') }}</a>
    </div>
    <div class="content">
      <!--Loading spinner-->
      <div v-if="loading" class="tc pv3">
        <div class="m-auto" style="width:20px;">
          <half-circle-spinner
            :animation-duration="1000"
            :size="15"
            color="#808080"
          />
        </div>
      </div>

      <!-- Exist request -->
      <ul v-if="!loading && requestsSent.length > 0" class="relative list pa0 ma0">
        <li v-for="contact in requestsSent" :key="contact.id" v-if="contact.state !== 'removed'" class="pv2">
          <div class="fl">
            <a :href="'/contact/' + contact.id" class="mb-1 dib">
              <img :src="contact.avatar" v-if="contact.avatar" class="mr-2" width="30">
              <div v-if="contact.initials" class="default-avatar mr-2" :style="{backgroundColor: contact.default_avatar_color}" style="width:30px; height:30px; font-size:10px; padding-top:7px;">{{ contact.initials }}</div><span>{{ contact.first_name }}</span>
            </a>
          </div>
          
          <!-- Actions -->
          <div class="fr dib">
            <!-- Send Friend Request -->
            <button v-if="contact.state === 'canceled'" class="btn default-btn b btn-sm f7" @click="add(contact.id)">
              {{ __('user.add_cta') }}
            </button>

            <!-- Remove User -->
            <button v-if="contact.state === 'canceled'" class="btn btn-sm btn-link light-gray-text f7" @click="remove(contact.id)">
              {{ __('user.remove_cta') }}
            </button>

            <!-- Cancel Request -->
            <button v-if="contact.state === 'requestSent'" class="btn btn-sm btn-link light-gray-text f7" @click="cancel(contact.id)">
              {{ __('user.cancel_cta') }}
            </button>
          </div>
        </li>
      </ul>

      <!-- Empty request -->
      <div v-if="!loading && requestsSent.length === 0" class="tc mv3">
        <div class="f6 light-gray-text">{{ __('user.empty_requests_sent') }}</div>
      </div>
    </div>
  </div>
</template>

<script>
  import { HalfCircleSpinner } from 'epic-spinners'
  export default {
    components: {
      HalfCircleSpinner
    },

    data () {
      return {
        enableSeeAll: false,
        loading: true,
        requestsSent: [],
      };
    },
    
    mounted() {
      this.prepareComponent();
    },
    
    props: [],
    
    methods: {
      prepareComponent() {
        this.getRequestsSent();
      },
  
      getRequestsSent() {
        axios.get('/relationships/requests-sent')
        .then(response => {
          this.enableSeeAll = response.data.enableSeeAll;
          this.requestsSent = response.data.requestsSent;
          this.loading = false;
        });
      },

      add(userId) {
        axios.post('/relationships/' + userId + '/add')
        .then(response => {
          let contact = this.requestsSent.find(contact => contact.id === userId);
          contact.state = 'requestSent';
        });
      },

      remove(userId) {
        let contact = this.requestsSent.find(contact => contact.id === userId);
        contact.state = 'removed';
      },
      
      cancel(userId) {
        axios.post('/relationships/' + userId + '/cancel')
        .then(response => {
          let contact = this.requestsSent.find(contact => contact.id === userId);
          contact.state = 'canceled';
        });
      },
    }
  }
</script>
