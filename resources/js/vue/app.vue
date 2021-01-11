<template>
  <div
    class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans"
  >
    <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
      <div class="mb-4">
        <h1 class="text-xl font-blod text-grey-darkest">Todo List</h1>
        <add-item-form v-on:reloadList="getList()" />
      </div>
      <list-view v-on:reloadList="getList()" :items="items" />
    </div>
  </div>
</template>

<script>
import addItemForm from "./addItemForm.vue";
import ListView from "./listView.vue";

export default {
  components: { addItemForm, ListView },

  data: () => {
    return {
      items: [],
    };
  },
  methods: {
    getList() {
      axios
        .get("api/items")
        .then((res) => {
          if (res.status == 200) {
            this.items = res.data;
          }
        })
        .catch((error) => {
          return console.log(error);
        });
    },
  },
  created() {
    this.getList();
  },
};
</script>
