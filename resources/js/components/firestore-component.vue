<script>
// import { onBeforeMount, onMounted, onBeforeUpdate , onUpdated, onBeforeUnmount, onUnmounted, ref} from 'vue'
import axios from "axios";

export default {
    data() {
        return {
            talks: [],
            ids: [],
            storeData: {
                talk: "",
                type: ""
            },
            updateData: {
                talk: "",
                type: "",
                updateId: "",
            },
            // result: false
        }
    },
    // setup() {
    //     onMounted(() => {
    //         console.log('mounted');
    //     })
    // },
    methods: {
        async load() {
            console.log('loading...')
            const {data} = await axios.get("/api/firestore");
            this.talks = data.apiData;
            this.ids = data.ids;
        },
        inputtedStoreTalk(event) {
            console.log(event.target.value)
            this.storeData.talk = event.target.value;
        },
        inputtedStoreType(event) {
            this.storeData.type = event.target.value;
        },
        async store() {
            console.log('store data: ', this.storeData);
            const {data} = await axios.post("/api/firestore-store", this.storeData);
            console.log(data);
            // this.result = true;
            // setTimeout(function() {
            //     this.result = false;
            // }, 5000);
        },
        inputtedUpdateTalk(event) {
            this.updateData.talk = event.target.value;
        },
        inputtedUpdateType(event) {
            this.updateData.type = event.target.value;
        },
        changeUpdateId(event) {
            this.updateData.updateId = event.target.value;
        },
        async update() {
            console.log('update data: ', this.updateData);
            if (!this.updateData.updateId) {
                alert("idがnull")
                return;
            }
            const {data} = await axios.post("/api/firestore-update", this.updateData);
            console.log(data);
        },

    }
}
</script>

<template>
    <h2>Firestore</h2>
    <!-- <h4 v-if="result">DONE!!!</h4> -->
    <div style="margin: 30px">
        <ul v-for="(talk, key) in talks" :key="key" style="margin: 30px">
            <li>No. {{key + 1}}</li>
            <li>talk: {{talk.talk}}</li>
            <li>type: {{talk.type}}</li>
        </ul>
        <input type="button" @click="load" value="load">
    </div>
    <div style="margin: 30px">
        <h2>新規登録</h2>
        <form action="">
            <div>
                talk<input type="text" name="talk" @input="inputtedStoreTalk">
            </div>
            <div>
                type<input type="number" name="type" @input="inputtedStoreType">
            </div>
            <div>
                登録<input type="button" @click="store()" value="登録">
            </div>
        </form>
    </div>
    <div style="margin: 30px">
        <h2>更新</h2>
        <select @change="changeUpdateId">
            <option v-for="(id, key) in ids" :key="key" :value="id">No. {{key+1}} :{{id}}</option>
        </select>
        <form action="">
            <div>
                talk<input type="text" name="talk" @input="inputtedUpdateTalk">
            </div>
            <div>
                type<input type="number" name="type" @input="inputtedUpdateType">
            </div>
            <div>
                登録<input type="button" @click="update()" value="登録">
            </div>
        </form>
    </div>
</template>