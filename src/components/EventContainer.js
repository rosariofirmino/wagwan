import React from "react";
import Event from "./Event";

export default function EventContainer(props) {
  return (
    <div>      
      {props.data.map((event) => (
        <Event title={event.title} description={event.description} category ={event.category} />
      ))}
    </div>
  );
}
