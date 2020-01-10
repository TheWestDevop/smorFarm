<template>

    <div class=" d-lg-inline">
        <div class=" mt-3 font-weight-bold">

        </div>
    <ul class="pagination">
        <li class="btn m-1">
            Total : {{paginations.total}}
        </li>
    <li style="color:black;border:1px #c7c3c3 solid" class="btn m-1" v-if="paginations.current_page > 1">
        <a href="javascript:void(0)" aria-label="Previous" v-on:click.prevent="changePage(paginations.current_page - 1)">
            <span aria-hidden="true" class="text-black">Previous</span>
            </a>
        </li>
    <li style="color:blackborder:1px #c7c3c3 solid" class="btn m-1" v-for="(page,n) in pagesNumber" :class="{'btn-primary': page == paginations.current_page}" :key="n">
        <div v-on:click.prevent="changePage(page)">{{ page }}</div>
        </li>
    <li style="color:black;border:1px #c7c3c3 solid" class="btn m-1" v-if="paginations.current_page < paginations.last_page">
        <a href="javascript:void(0)" aria-label="Next" v-on:click.prevent="changePage(paginations.current_page + 1)">
            <span aria-hidden="true" class="text-black">Next</span>
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
