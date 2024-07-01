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
        <h3 class="title my-4 text-uppercase">Twoje dane z bazy danych</h3>
        <table class="table overflow-y-auto">
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
        <div class="back-to-for">
            <button @click="$emit('back-to-form')" class="button">Wrócić się do formy</button>
        </div>
    </div>
</template>

<style>
.form-success {
    table {
        td {
            overflow-wrap: anywhere;        
        }
    }

    position: relative;
    .back-to-for {
        position: absolute;
        bottom: -100px;
        .button {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
            backdrop-filter: blur(10px);
            text-decoration: none;

            &:hover {
                background: rgba(255, 255, 255, 0.3);
            }
        }
    }
}
</style>