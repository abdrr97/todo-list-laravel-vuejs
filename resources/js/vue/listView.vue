<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
      <list-item
        v-if="!item.completed"
        :item="item"
        class="item"
        v-on:itemChanged="$emit('reloadList')"
      ></list-item>

      <list-item
        v-if="item.completed"
        :item="item"
        class="item"
        v-on:itemChanged="$emit('reloadList')"
      ></list-item>
    </div>
  </div>
</template>

<script>
import listItem from "./listItem.vue";
export default {
  props: ["items"],
  components: { listItem },
};
</script>
