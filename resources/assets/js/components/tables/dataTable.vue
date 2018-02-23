<template>
    <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%"></table>
</template>

<script>


import 'bootstrap/dist/css/bootstrap.min.css';
import 'datatables.net-bs4/css/dataTables.bootstrap4.css';
import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'
import 'datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'

import 'bootstrap'
import 'datatables.net-bs4'
import 'datatables.net-buttons-bs4'
import 'datatables.net-responsive-bs4'

export default {
  props: ['configs'],
  data() {
    return {
      headers: [
        { data: 'name', title: 'Name', class: 'some-special-class' },
        { data: 'position', title: 'Position' },
        { data: 'salary', title: 'Salary' },
        { data: 'start_date', title: 'Start_date' },
        { data: 'office', title: 'Office' },
        { data: 'extn', title: 'Extn' }
      ],
      rows: [
          {
              "name":       "Tiger Nixon",
              "position":   "System Architect",
              "salary":     "$3,120",
              "start_date": "2011/04/25",
              "office":     "Edinburgh",
              "extn":       "5421"
          },
          {
              "name":       "Garrett Winters",
              "position":   "Director",
              "salary":     "$5,300",
              "start_date": "2011/07/25",
              "office":     "Edinburgh",
              "extn":       "8422"
          }
      ],
      dtHandle: null
    }
  },
  // watch: {
  //   users(val, oldVal) {
  //     let vm = this;
  //     vm.rows = [];
  //     // You should _probably_ check that this is changed data... but we'll skip that for this example.
  //     val.forEach(function (item) {
  //       // Fish out the specific column data for each item in your data set and push it to the appropriate place.
  //       // Basically we're just building a multi-dimensional array here. If the data is _already_ in the right format you could
  //       // skip this loop...
  //       let row = [];
  //
  //       row.push(item.id);
  //       row.push(item.username);
  //       row.push(item.name);
  //       row.push(item.phone);
  //       row.push('<a href="mailto://' + item.email + '">' + item.email + '</a>');
  //       row.push('<a href="http://' + item.website + '" target="_blank">' + item.website + '</a>');
  //
  //       vm.rows.push(row);
  //     });
  //
  //     // Here's the magic to keeping the DataTable in sync.
  //     // It must be cleared, new rows added, then redrawn!
  //     vm.dtHandle.clear();
  //     vm.dtHandle.rows.add(vm.rows);
  //     vm.dtHandle.draw();
  //   }
  // },
  mounted() {
    //  再使用之前改變 dataTable 原始碼的預設
    window.$.fn.dataTable.ext.errMode = function(s, h, m) {
        console.log(m);
    };

    let vm = this;
    // Instantiate the datatable and store the reference to the instance in our dtHandle element.
    vm.dtHandle = $(this.$el).DataTable({
      // Specify whatever options you want, at a minimum these:
      processing: true,
      serverSide: true,
      ajax: "data/data.json",
      columns: vm.headers,
      data: vm.rows
    });

    console.log(vm);


  }
}
</script>
