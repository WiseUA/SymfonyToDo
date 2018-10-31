import React from 'react';
import { Card, CardTitle, CardText } from 'material-ui/Card';

const Task = ({ title, description, user, dueDate, status }) => (
  <Card>
    <CardTitle title={title}/>
    <CardText>{description}</CardText>
    <CardText>{user}</CardText>
    <CardText>{dueDate}</CardText>
    <CardText>{status}</CardText>
  </Card>
);

export default Task;