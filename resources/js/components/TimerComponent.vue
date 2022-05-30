<template>
  <div>
    <span>{{ time.hours }}:{{ time.minutes }}:{{ time.seconds }}</span>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["useractivity", "timeserver"],

  data() {
    return {
      now: new Date(),
      timeDiff: 0
    };
  },
  created() {
    this.timeDiff = moment(this.timeserver).diff(moment(),"milliseconds");
    this.now = moment().add(this.timeDiff,"milliseconds");
    let interval = this.intervals();
    
  },
  computed: {
    time() {
      let time = moment.duration(
        this.now - Date.parse(this.useractivity.pivot.created_at)
      );

      let data = {
        total: moment.utc(time.asMilliseconds()).format("H:mm:ss"),
        hours: this.addZero(time.days() * 24 + time.hours()),
        minutes: this.addZero(time.minutes()),
        seconds: this.addZero(time.seconds())
      }

      this.$emit("time", data);

      return data;
    }
  },
  methods: {
    addZero(num) {
      return num < 10 ? "0" + num : num;
    },
    intervals() {
      return setInterval(() => {
        this.now = moment().add(this.timeDiff,"milliseconds");
      }, 1000);
    }
  }
};
</script>