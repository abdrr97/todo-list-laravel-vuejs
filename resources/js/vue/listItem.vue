<template>
  <div class="flex mb-4 items-center">
    <p
      :class="[
        item.completed
          ? ['text-green-600', 'font-bold', 'line-through']
          : 'text-grey-darkest',
        'w-full',
      ]"
    >
      {{ item.name }}
    </p>
    <input
      class="flex-no-shrink p-2 ml-4 mr-2 border-2 rounded cursor-pointer text-green border-green hover:bg-green"
      type="checkbox"
      @change="updateCheck()"
      v-model="item.completed"
    />

    <button
      @click="removeItem()"
      class="flex-no-shrink px-1 text-sm ml-2 border-2 rounded text-red-600 border-red-500 hover:text-white hover:bg-red-400"
    >
      Remove
    </button>
  </div>
</template>

<script>
export default {
  props: ["item"],
  methods: {
    updateCheck() {
      axios
        .put(`api/item/${this.item.id}`, {
          item: this.item,
        })
        .then((res) => {
          if (res.status == 200) {
            this.$emit("itemChanged");
          }
        })
        .catch((error) => {
          return console.log(error);
        });
    },
    removeItem() {
      axios
        .delete(`api/item/${this.item.id}`, {
          item: this.item,
        })
        .then((res) => {
          if (res.status == 200) {
            this.$emit("itemChanged");
          }
        })
        .catch((error) => {
          return console.log(error);
        });
    },
  },
};
</script>
