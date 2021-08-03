<template>
  <div class="relative p-2 flex overflow-x-auto h-full">

    <!-- Columns  -->
    <div
      v-for="column in columns"
      :key="column.slug"
      class="mr-6 w-4/5 max-w-xs flex-1 flex-shrink-0"
    >
      <div class="rounded-md shadow-md overflow-hidden">
        <div class="p-3 flex justify-between items-baseline bg-blue-800 ">
          <h4 class="font-medium text-white">
            {{ status.title }}
          </h4>
          <button class="py-1 px-2 text-sm text-orange-500 hover:underline">
            Add Card
          </button>
        </div>
        <div class="p-2 flex-1 flex flex-col h-full overflow-x-hidden overflow-y-auto bg-blue-100">

  // ...
  <div class="p-2 bg-blue-100">
  <AddTaskForm
    v-if="newCardForColumn === column.id"
    :column-id="column.id"
    v-on:card-added="handleCardAdded"
    v-on:card-canceled="closeAddCardForm"
  />
          <!-- Tasks -->
          <draggable
      class="flex-1 overflow-hidden"
      v-model="column.cards"
      v-bind="cardDragOptions"
      @end="handleCardMoved"
    >
      <transition-group
        class="flex-1 flex flex-col h-full overflow-x-hidden overflow-y-auto rounded shadow-xs"
        tag="div"
      >
          <div
            v-for="card in column.cards"
            :key="card.id"
            class="mb-3 p-3 h-24 flex flex-col bg-white rounded-md shadow transform hover:shadow-md cursor-pointer"
          >
            <span class="block mb-2 text-xl text-gray-900">
              {{ card.title }}
            </span>
            <p class="text-gray-700 truncate">
              {{ card.description }}
            </p>
          </div>
          <!-- ./Tasks -->
</transition-group>
    </draggable>
          <!-- No Tasks -->
          <div
            v-show="!column.cards.length"
            class="flex-1 p-4 flex flex-col items-center justify-center"
          >
            <span class="text-gray-600">No tasks yet</span>
            <button
              class="mt-1 text-sm text-orange-600 hover:underline"
            >
              Add one
            </button>
          </div>
          <!-- ./No Tasks -->
        </div>
      </div>
    </div>
    <!-- ./Columns -->

  </div>
  </div>
</template>

<script>
import draggable from "vuedraggable"; 
export default {
  components: { draggable, AddCardForm }, // register 
  // ...
  computed: {
    cardDragOptions() {
      return {
        animation: 200,
        group: "card-list",
        dragClass: "column-drag"
      };
    }
  },
  // ...
  methods: {
    // ...
    handleCardMoved() {
      // Send the entire list of statuses to the server
      axios.put("/cards/sync", {columns: this.columns}).catch(err => {
        console.log(err.response);
      });
    }
  }
};
</script>
<style scoped>
.column-drag {
  transition: transform 0.5s;
  transition-property: all;
}
</style>