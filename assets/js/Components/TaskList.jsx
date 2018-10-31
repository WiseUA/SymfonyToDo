import React from 'react';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import Task from "./Task";


class TaskList extends React.Component {
  constructor() {
    super();

    this.state = {
      entries: []
    };
  }

  componentDidMount() {
    fetch('/api/tasks.json')
      .then(response => response.json())
      .then(entries => {
        this.setState({
          entries
        });
      });
  }

  render() {
    return (
      <MuiThemeProvider>
        <div style={{ display: 'flex' }}>
          {this.state.entries.map(
            ({ title, description, user, dueDate, status }) => (
              <Task
                title={title}
                description={description}
                user={user}
                dueDate={dueDate}
                status={status}
              >
              </Task>
            )
          )}
        </div>
      </MuiThemeProvider>
    );
  }
}

export default TaskList;




