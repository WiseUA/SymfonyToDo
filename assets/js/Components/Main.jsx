import React from 'react';
import AddTaskModal from "./AddTaskModal";
import TaskList from "./TaskList";


class Main extends React.Component {
  render() {
    return (
      <div>
        <AddTaskModal/>
        <TaskList/>
      </div>
    );
}}



export default Main;
