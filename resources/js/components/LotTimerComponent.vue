<template>
    <div class="bg-info rounded-lg d-flex justify-content-around p-3">
        <div
            class="col-2 text-center bg-light rounded font-weight-bold text-center d-flex flex-column justify-content-center align-items-center">
            <p class="text-danger text-b m-0">{{ days }}</p>
            <p class="m-0">Дни</p>
        </div>
        <div
            class="col-2 text-center bg-light rounded font-weight-bold text-center d-flex flex-column justify-content-center align-items-center">
            <p class="text-danger text-b m-0">{{ hours }}</p>
            <p class="m-0">Часы</p>
        </div>
        <div
            class="col-2 text-center bg-light rounded font-weight-bold text-center d-flex flex-column justify-content-center align-items-center">
            <p class="text-danger text-b m-0">{{ minutes }}</p>
            <p class="m-0">Минуты</p>
        </div>
        <div
            class="col-2 text-center bg-light rounded font-weight-bold text-center d-flex flex-column justify-content-center align-items-center">
            <p class="text-danger text-b m-0">{{ seconds }}</p>
            <p class="m-0">Секунды</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['lot'],

        data() {
            return {
                date_end: this.lot.end_time,
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00',
            }
        },

        mounted() {
            this.timer()
        },

        methods: {
            timer() {
                let this_timer = this;
                let set_interval_id = setInterval(function () {
                    let date = (new Date(this_timer.date_end).getTime()) - Date.now();

                    let tdays = Math.floor(date / (1000 * 60 * 60 * 24));
                    let thours = Math.floor((date % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let tminutes = Math.floor((date % (1000 * 60 * 60)) / (1000 * 60));
                    let tseconds = Math.floor((date % (1000 * 60)) / 1000);

                    this_timer.days = tdays < 10 ? `0${tdays}` : tdays;
                    this_timer.hours = thours < 10 ? `0${thours}` : thours;
                    this_timer.minutes = tminutes < 10 ? `0${tminutes}` : tminutes;
                    this_timer.seconds = tseconds < 10 ? `0${tseconds}` : tseconds;

                    if (date < 1000) clearInterval(set_interval_id);
                }, 1000);
            }
        },
    }
</script>
