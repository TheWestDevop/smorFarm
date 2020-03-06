<template>

    <div class=" d-lg-inline">
    <ul class="pagination justify-content-center mb-0">
    
    <li  class="page-item" v-if="paginations.current_page > 1">
        <a href="javascript:void(0)" aria-label="Previous" class="page-link" v-on:click.prevent="changePage(paginations.current_page - 1)">
            <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
            </a>
        </li>
    <li  class="page-item" v-for="(page,n) in pagesNumber" :class="{'active': page == paginations.current_page}" :key="n">
        <a href="javascript:void(0)" class="page-link" v-on:click.prevent="changePage(page)">{{ page }}</a>
        </li>
    <li  class="page-item" v-if="paginations.current_page < paginations.last_page">
        <a href="javascript:void(0)" class="page-link" aria-label="Next" v-on:click.prevent="changePage(paginations.current_page + 1)">
            <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
    </div>
</template>
<script>
  export default{
      props: {
      paginations: {
          type: Object,
          required: true
      },
      offset: {
          type: Number,
          default: 4
      }
    },
    computed: {
      pagesNumber() {
        if (!this.paginations.to) {
          return [];
        }
        let from = this.paginations.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        let to = from + (this.offset * 2);
        if (to >= this.paginations.last_page) {
          to = this.paginations.last_page;
        }
        let pagesArray = [];
        for (let page = from; page <= to; page++) {
          pagesArray.push(page);
        }
          return pagesArray;
      }
    },
    methods : {
      changePage(page) {
        this.paginations.current_page = page;
        this.$emit('paginate');
      }
    }
  }
</script>
