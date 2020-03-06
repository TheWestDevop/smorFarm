<template>
  <div class="paginatoin-area" v-if="paginations.to < paginations.total">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <p>Showing {{paginations.from}}-{{paginations.to}} of {{paginations.total}} item(s)</p>
          </div>
          <div class="col-lg-6 col-md-6">
            <ul class="pagination-box">
              <li>
                <a href="javascript:void(0)" class="Previous" @click="changePage(paginations.current_page - 1)">
                  <i class="fa fa-chevron-left"></i> Previous
                </a>
              </li>
              <li
                v-for="(page,n) in pagesNumber"
                :class="{'active': page == paginations.current_page}"
                :key="n"
              >
              <a href="javascript:void(0)" @click.prevent="changePage(page)">{{ page }}</a>
                
              </li>
              <li>
                <a href="javascript:void(0)" class="Next" @click.prevent="changePage(paginations.current_page + 1)">
                  Next
                  <i class="fa fa-chevron-right"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
</template>
<script>
export default {
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
      let to = from + this.offset * 2;
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
  methods: {
    changePage(page) {
      this.paginations.current_page = page;
      this.$emit("paginate");
    }
  }
};
</script>
