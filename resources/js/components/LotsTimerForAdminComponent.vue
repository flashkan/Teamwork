<template>
    <div>
        <div v-if="open_lot === true">
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
        </div>
        <div v-else class="alert alert-primary" role="alert">Этот лот закрыт</div>
    </div>
</template>

<script>
    export default {
        props: ['lot'],

        data() {
            return {
                open_lot: true,
                date_end: new Date(this.lot.end_time).getTime(),
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00',
            }
        },

        mounted() {
            if (this.date_end > Date.now()) this.timer();
            else this.open_lot = false;
        },

        methods: {
            timer() {
                let this_timer = this;
                let set_interval_id = setInterval(function () {
                    let date = this_timer.date_end - Date.now();

                    let tdays = Math.floor(date / (1000 * 60 * 60 * 24)).toString();
                    let thours = Math.floor((date % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString();
                    let tminutes = Math.floor((date % (1000 * 60 * 60)) / (1000 * 60)).toString();
                    let tseconds = Math.floor((date % (1000 * 60)) / 1000).toString();

                    this_timer.days = tdays.padStart(2, '0');
                    this_timer.hours = thours.padStart(2, '0');
                    this_timer.minutes = tminutes.padStart(2, '0');
                    this_timer.seconds = tseconds.padStart(2, '0');

                    if (date < 1000) {
                        this_timer.open_lot = false;
                        clearInterval(set_interval_id);
                    }
                }, 1000);
            }
        },
    }
</script>
