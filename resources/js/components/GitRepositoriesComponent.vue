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
            @click="toggle(repository.id, repository.commits_url)"
            :class="{ opened: opened.includes(repository.id) }"
            data-toggle="collapse"
            data-target="#demo1"
            class="accordion-toggle"
        >
          <td>
            <i
                class="now-ui-icons p-2 font-weight-bolder"
                :class="[ opened.includes(repository.id) ? 'ui-1_simple-delete' : 'ui-1_simple-add'  ]"
            ></i>
            {{ repository.name }}
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
        <tr
            class="p"
            v-if="opened.includes(repository.id)"
        >
              <commits-component
                  v-if="commits"
                  :commits="commits"
              ></commits-component>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import moment from 'moment'
import CommitsComponent from "./CommitsComponent";

export default {
  components: {CommitsComponent},
  data() {
    return {
      opened: [],
      commits: [],
    }
  },
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
    toggle(id, commitsUrl) {
      const index = this.opened.indexOf(id);
      if (index > -1) {
        this.opened.splice(index, 1)
      } else {
        const url = commitsUrl.replace('{/sha}', '');
        axios.get(url).then(resp => {
          this.commits = resp.data;
        });
        console.log(this.commits);
        this.opened.push(id)

      }
    }
  },
  mounted() {
    console.log('Component mounted.', this.repositories)
  }
}
</script>
