<template>
  <div class="flex mt-4">
    <input
      v-model="item.name"
      class="shadow-md appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker"
      placeholder="Add Todo"
    />
    <button
      @click="addItem()"
      class="flex-no-shrink p-2 border-1 rounded text-blue-400 border-blue-400 hover:text-white hover:bg-blue-400"
    >
      Add
    </button>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      item: {
        name: "",
      },
    };
  },
  methods: {
    addItem() {
      if (this.item.name == "") {
        return console.log("form empty");
      }
      axios
        .post("api/item/store", {
          item: this.item,
        })
        .then((res) => {
          if (res.status == 200) {
            this.item.name = "";
            this.$emit("reloadList");
          }
        })
        .catch((error) => {
          return console.log(error);
        });
    },
  },
};
</script>

