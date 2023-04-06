import React, { Component } from "react";

export default class Event extends React.Component {
  // add more variables in constructor later like price, address, likes, etc
  constructor(props) {
    super(props);
    this.state = {
      title: props.title,
      description: props.description,
      likes: Math.round(Math.random() * 100), //random like amount for now
      liked: false,
      // this.likedIcon used to change heart from empty to full
      likedIcon:
        "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z",
      // set images
      // set images
      img: "https://www.squareclub.si/images/hero/2.jpg", //default image i guess
    };
    if (props.category == "nightlife") {
      this.state.img = "https://www.squareclub.si/images/hero/2.jpg";
    }
    if (props.category == "market") {
      this.state.img =
        "https://bloximages.chicago2.vip.townnews.com/tucson.com/content/tncms/assets/v3/editorial/6/45/645ff446-eb80-5fcc-bc85-c6e7d8ea091f/5fb81c841e82f.image.jpg?resize=1200%2C900";
    }
    if (props.category == "concert") {
      this.state.img =
        "https://upload.wikimedia.org/wikipedia/commons/c/cb/Classical_spectacular10.jpg";
    }
    if (props.category == "food") {
      this.state.img =
        "https://cdn.vox-cdn.com/thumbor/5d_RtADj8ncnVqh-afV3mU-XQv0=/0x0:1600x1067/1200x900/filters:focal(672x406:928x662)/cdn.vox-cdn.com/uploads/chorus_image/image/57698831/51951042270_78ea1e8590_h.7.jpg";
    }
    if (props.category == "museum") {
      this.img =
        "https://www.ringling.org/sites/default/files/styles/800x450_mcrop/public/basic_page_image/DSC00490_web_0.jpg?itok=kgk7MO8l";
    }
  }

  handleRegionClick(id) {
    // called when they hit the like button
    if (this.state.liked === false) {
      this.setState((prevState) => ({
        likes: prevState.likes + 1,
        liked: true,
        likedIcon:
          "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z",
      }));
    } else {
      this.setState((prevState) => ({
        likes: prevState.likes - 1,
        liked: false,
        likedIcon:
          "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z",
      }));
    }
  }

  render() {
    return (
      <div
        id="card"
        className="card card-block mx-2"
        style={{ minWidth: "400px" }}
      >
        <img
          className="card-img-body"
          src={this.state.img}
          alt="Card image"
          width="400px"
          height="400px"
          style={{ opacity: "0.3" }}
        ></img>
        <div className="card-img-overlay">
          <h3 style={{ color: "white" }}>{this.state.title}</h3>

          <p style={{ color: "white" }}>{this.state.description}</p>
        </div>
        <div className="card-img-overlay d-flex align-items-end">
          <button
            onClick={() => this.handleRegionClick(this.id)}
            type="button"
            class="align-self-end btn btn-dark"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="32"
              height="32"
              fill="white"
              class="bi bi-heart"
              viewBox="0 0 16 16"
            >
              <path d={this.state.likedIcon} />
            </svg>
          </button>
          <h3 style={{ color: "white" }}>&nbsp; {this.state.likes}</h3>
        </div>
      </div>
    );
  }
}
