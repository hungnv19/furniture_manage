<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card p-3">
            <v-row class="fill-height">
              <v-col>
                <v-sheet height="64">
                  <v-toolbar flat>
                    <v-btn
                      outlined
                      class="mr-4"
                      color="grey darken-2"
                      @click="setToday"
                    >
                      Today
                    </v-btn>
                    <v-btn fab text small color="grey darken-2" @click="prev">
                      <v-icon small> mdi-chevron-left </v-icon>
                    </v-btn>
                    <v-btn fab text small color="grey darken-2" @click="next">
                      <v-icon small> mdi-chevron-right </v-icon>
                    </v-btn>
                    <v-toolbar-title >
                      Title
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu bottom right>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          outlined
                          color="grey darken-2"
                          v-bind="attrs"
                          v-on="on"
                        >
                          <span></span>
                          <v-icon right> mdi-menu-down </v-icon>
                        </v-btn>
                      </template>
                      <v-list>
                        <v-list-item @click="type = 'day'">
                          <v-list-item-title>Day</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="type = 'week'">
                          <v-list-item-title>Week</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="type = 'month'">
                          <v-list-item-title>Month</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="type = '4day'">
                          <v-list-item-title>4 days</v-list-item-title>
                        </v-list-item>
                      </v-list>
                    </v-menu>
                  </v-toolbar>
                </v-sheet>
                <v-sheet height="600">
                  <v-calendar
                    ref="calendar"
                    v-model="focus"
                    color="primary"
                    :locale="lang"
                    :events="events"
                    :event-color="getEventColor"
                    :type="type"
                    @click:event="showEvent"
                    @click:more="viewDay"
                    @click:date="viewDay"
                    @change="updateRange"
                  ></v-calendar>
                  <v-menu
                    v-model="selectedOpen"
                    :close-on-content-click="false"
                    :activator="selectedElement"
                    offset-x
                  >
                    <v-card color="grey lighten-4" min-width="350px" flat>
                      <v-toolbar :color="selectedEvent.color" dark>
                        <!-- <router-link
                          :to="{
                            name: 'editBooking',
                            params: { id: selectedEvent.id },
                          }"
                          class="btn btn-sm btn-primary mr-1"
                        >
                          <v-icon>mdi-pencil</v-icon>
                        </router-link> -->

                        <v-toolbar-title>name</v-toolbar-title>
                        <v-spacer></v-spacer>
                      </v-toolbar>
                      <v-card-text>
                        <span>note</span>
                      </v-card-text>
                      <v-card-actions>
                        <v-btn
                          text
                          color="secondary"
                          @click="selectedOpen = false"
                        >
                          Cancel
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-menu>
                </v-sheet>
              </v-col>
            </v-row>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    focus: "",
    type: "month",
    lang: localStorage.getItem("sm-lang")
      ? localStorage.getItem("sm-lang")
      : localStorage.setItem("sm-lang", "en"),
    typeToLabel: {
      month: "Month",
      week: "Week",
      day: "Day",
      "4day": "4 Days",
    },
    // typeToLabel: "",
    selectedEvent: {},
    selectedElement: null,
    selectedOpen: false,
    events: [],
    appointments: "",
    colors: [
      "blue",
      "indigo",
      "deep-purple",
      "cyan",
      "green",
      "orange",
      "grey darken-1",
    ],
  }),
  mounted() {
    // this.typeToLabel = {
    //   month: $t("common.time.month"),
    //   week: $t("common.time.week"),
    //   day: $t("common.time.day"),
    //   "4day": "4 " + $t("common.time.days"),
    // };
    // this.getAllAppointments();
    // this.$refs.calendar.checkChange();
  },
  methods: {
   
    viewDay({ date }) {
      this.focus = date;
      this.type = "day";
    },
    getEventColor(event) {
      return event.color;
    },
    setToday() {
      this.focus = "";
    },
    prev() {
      this.$refs.calendar.prev();
    },
    next() {
      this.$refs.calendar.next();
    },
    showEvent({ nativeEvent, event }) {
      const open = () => {
        this.selectedEvent = event;
        this.selectedElement = nativeEvent.target;
        requestAnimationFrame(() =>
          requestAnimationFrame(() => (this.selectedOpen = true))
        );
      };

      if (this.selectedOpen) {
        this.selectedOpen = false;
        requestAnimationFrame(() => requestAnimationFrame(() => open()));
      } else {
        open();
      }

      nativeEvent.stopPropagation();
    },
    updateRange({ start, end }) {
      setTimeout(() => {
        const events = [];

        this.appointments.forEach((e) => {
          let dateTime = new Date(e.date + " " + e.start_time);
          let today = new Date();
          if (dateTime >= today) {
            events.push({
              name: e.customer.name,
              id: e.id,
              // employeeName: e.employee.name,
              start: e.date + " " + e.start_time,
              end: e.date + " " + e.end_time,
              color: this.colors[this.rnd(0, this.colors.length - 1)],
              note: e.note,
              timed: true,
            });
          }
        });

        this.events = events;
      }, 500);
    },

    rnd(a, b) {
      return Math.floor((b - a + 1) * Math.random()) + a;
    },
  },
};
</script>
