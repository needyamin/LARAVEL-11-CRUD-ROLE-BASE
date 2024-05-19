@extends('layouts.main')
@section('title', 'Agent Information')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Agent Information</h2>
      <form>
        <div class="form-group">
          <label for="phoneInput">Enter Phone Number:</label>
          <input type="text" class="form-control" id="phoneInput">
        </div>
        <button type="button" class="btn btn-primary" onclick="searchAgent()">Search</button>
      </form>
    </div>
    <div class="col-md-12 mt-3" id="agentInfo">
      <!-- Agent information will be displayed here -->
    </div>
  </div>
</div>


<script>
function searchAgent() {
  var phone = document.getElementById("phoneInput").value;
  var apiUrl = "http://oams.test/api/agent_api?phone=" + phone;

  $.getJSON(apiUrl)
  .done(function(data) {
    if (data.error) {
      // Handle errors
      $('#agentInfo').html('<p>Error: ' + data.error + '</p>');
    } else if (data.message) {
      if (data.message === 'Failed to retrieve data from the API') {
        $('#agentInfo').html('<p>' + data.message + '</p>');
      } else if (data.message === 'No data found for the given phone number') {
        $('#agentInfo').html('<p>' + data.message + '</p>');
      }
    } else {
      // Display agent information in a Bootstrap table
      var agent = data[0];
      var agentInfoHtml = "<div class='card'>";
      agentInfoHtml += "<div class='card-body'>";
      agentInfoHtml += "<h5 class='card-title'>Agent Information</h5>";
      agentInfoHtml += "<table class='table'>";
      agentInfoHtml += "<tbody>";
      agentInfoHtml += "<tr><td><strong>Name:</strong></td><td>" + agent.first_name + " " + agent.last_name + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Username:</strong></td><td>" + agent.username + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Referer:</strong></td><td>" + agent.referer + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Agents:</strong></td><td>" + agent.agents + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Users:</strong></td><td>" + agent.users + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Properties:</strong></td><td>" + agent.properties + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>City:</strong></td><td>" + agent.city_name + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Last Login:</strong></td><td>" + agent.last_login + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Updated At:</strong></td><td>" + agent.updated_at + "</td></tr>";
      agentInfoHtml += "<tr><td><strong>Rank Updated At:</strong></td><td>" + agent.con_agent_rank_updated_at + "</td></tr>";
      agentInfoHtml += "</tbody></table>";
      agentInfoHtml += "</div></div>";

      $('#agentInfo').html(agentInfoHtml);
    }
  })
  .fail(function() {
    // Handle AJAX failure
    $('#agentInfo').html('<p>Failed to retrieve data from the API</p>');
  });
}
</script>

@endsection