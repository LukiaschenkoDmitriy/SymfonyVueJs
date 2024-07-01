<script lang="ts">
import { defineComponent } from 'vue';


export default defineComponent({
    name: "ContactSuccess",
    props: {
        results: {
            type: Object,
            required:true
        }
    },
    setup(props) {
        return {
            props
        };
    }
});
    
</script>

<template>
    <div class="form-success">
        <h3 class="title my-2">Twoje dane z bazy danych</h3>
        <table class="table overfhol overflow-y-auto">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Wiadomość</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item) in props.results">
                    <th scope="row">{{ item.id }}</th>
                    <td>{{ item.username}}</td>
                    <td>{{ item.lastname }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.message }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style>

</style>