<template>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="text-primary thead-dark ">
        <th>Name</th>
        <th>Visibility</th>
        <th>Open Issues</th>
        <th>Created At</th>
        <th>Updated At</th>
      </thead>
      <tbody
          v-for="repository in repositories"
          :key="repository.id"
      >
        <tr
            class="accordion-toggle"
        >
          <td>
            <a
                :href="`repos/${repository.owner['login']}/${repository.name}/commits`"
                class="stretched-link"
            >
              {{ repository.name }}
            </a>
          </td>

          <td>
            {{ repository.visibility }}
          </td>
          <td>
            {{ repository.open_issues }}
          </td>
          <td>
            {{ repository.created_at | formattedDate }}
          </td>
          <td>
            {{ repository.updated_at | formattedDate }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import moment from 'moment'

export default {
  props: {
    repositories: {
      type: Array
    }
  },
  filters: {
    formattedDate(value) {
      return moment(value).format('DD.MM.YYYY')
    }
  },
  methods: {
    moment() {
      return moment();
    },
  },
}
</script>
