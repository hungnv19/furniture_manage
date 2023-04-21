<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card p-3">
            <v-row class="fill-height">
              <v-col>
                <FullCalendar :options="calendarOptions" />
              </v-col>
            </v-row>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        selectable: true,
        select: this.handleDateSelect,
        events: this.getEvents,
        dateClick: this.handleDateClick,
        // events: [
        //   { title: "event 1", date: "2023-04-21" },
        //   { title: "event 2", date: "2019-04-02" },
        // ],
      },
      events: [],
    };
  },
  created() {
    console.log(this.events);
  },
  mounted() {
    this.getEvents();
  },
  methods: {
    handleDateClick: function (arg) {
      alert("Date: " + arg.dateStr);
    },
    getEvents() {
      axios
        .get("/get-booking")
        .then((response) => {
          this.events = response.data;
        })
        .catch();
    },
  },
};
</script>