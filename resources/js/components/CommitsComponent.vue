<template>
  <div class="table-responsive">
    <h4 class="card-title">Git Commits</h4>
    <table class="table table-bordered">
      <thead class="text-primary thead-light">
        <th>SHA</th>
        <th>Author</th>
        <th>Comments</th>
        <th>Committer</th>
        <th>Commit Message</th>
      </thead>
      <tbody>
        <tr
            v-for="commit in commits"
            :key="commit.id"
        >
          <td>
            {{ commit.sha }}
          </td>
          <td>
            {{ commit.commit.author.name }}
          </td>
          <td>
            {{ commit.comment_count }}
          </td>
          <td>
            {{ commit.commit.committer.name }}
          </td>
          <td>
            {{ commit.commit.message }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    commits: {
      type: Array
    }
  },
  mounted() {
    console.log('Commit Component mounted.', this.commits)
  }
}
</script>
