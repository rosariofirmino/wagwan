import React from 'react';
import ReactDOM from 'react-dom/client';
import { useState } from "react";

class Event extends React.Component {
  constructor(title, description, category){
    // add more variables in constructor later like price, address, likes, etc
    super();
      this.title = title;
      this.description = description;
      this.likes = Math.round(Math.random() * 100); //random like amount for now
      this.liked = false;
      // this.likedIcon used to change heart from empty to full
      this.likedIcon = "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z";

      // set images
      this.img = "https://www.squareclub.si/images/hero/2.jpg" //default image i guess
      if (category == "nightlife") {
        this.img = "https://www.squareclub.si/images/hero/2.jpg"
      }
      if (category == "market") {
        this.img = "https://bloximages.chicago2.vip.townnews.com/tucson.com/content/tncms/assets/v3/editorial/6/45/645ff446-eb80-5fcc-bc85-c6e7d8ea091f/5fb81c841e82f.image.jpg?resize=1200%2C900"
      }
      if (category == "concert") {
        this.img = "https://upload.wikimedia.org/wikipedia/commons/c/cb/Classical_spectacular10.jpg";
      }
      if (category == "food") {
        this.img = "https://cdn.vox-cdn.com/thumbor/5d_RtADj8ncnVqh-afV3mU-XQv0=/0x0:1600x1067/1200x900/filters:focal(672x406:928x662)/cdn.vox-cdn.com/uploads/chorus_image/image/57698831/51951042270_78ea1e8590_h.7.jpg";
      }
      if (category == "museum") {
        this.img = "https://www.ringling.org/sites/default/files/styles/800x450_mcrop/public/basic_page_image/DSC00490_web_0.jpg?itok=kgk7MO8l";
      }
      
  }

  handleRegionClick(id) {
    // called when they hit the like button
    if (this.liked == false) {
      this.likes = this.likes + 1;
      this.liked = true;
      this.likedIcon = "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z";
    }
    else {
      this.likes = this.likes - 1;
      this.liked = false;
      this.likedIcon = "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z";
    }
    
    RenderAll();
  }

  return() {
    return (
      <div id="card" className="card card-block mx-2" style={{minWidth: "400px"}}>
        <img className="card-img-body" src={this.img} alt="Card image" width="400px" height="400px" style={{opacity: "0.3"}}></img>
        <div className="card-img-overlay">

          <h3 style={{color: "white"}}>{this.title}</h3>

          <p style={{color: "white"}}>{this.description}</p>

        </div>
        <div className="card-img-overlay d-flex align-items-end">
          <button onClick={() => this.handleRegionClick(this.id)} type="button" class="align-self-end btn btn-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d={this.likedIcon}/>
                  </svg>
          </button>
          <h3 style={{color: "white"}}>&nbsp; {this.likes}</h3>
        </div>
      </div>
    );


    
  }
}

function returnArrayComponents(arr) {
  var topPostsComponents = [];
  for (var i = 0; i < arr.length; i++) {
    topPostsComponents.push(arr[i].return());
  }
  return (
    <>
    {topPostsComponents}
    </>
  );
}

var topPostsArray = [];
var tonightArray = [];
var weekendArray = [];
var likedArray = [];

// Examples just for prototype; eventually will read from database.
const Grog = new Event("Closing Rager @ Grog", "Celebrate Grog's final month in Gainesville!", "nightlife");
topPostsArray.push(Grog);
const Market = new Event("Vintage Market @ Midpoint Park", "Come check out the latest threads from your favorite local vendors", "market");
topPostsArray.push(Market);
const Concert = new Event("Kanye West Concert @ Stephen O'Connell Center", "Kanye is back! Come watch him perform the much anticipated Yandhi, his next studio album coming soon", "concert");
topPostsArray.push(Concert);
const Restaurant = new Event("Free Appetizer Night @ Piesanos", "We know how much you love those classic Piesanos rolls! Come stop by for some free Appetizers", "food");
topPostsArray.push(Restaurant);
const Museum = new Event("Museum Night @ Harn Art Museum", "Come see our new exhibit, called 'Wagwan', and the artists behind its creation", "museum");
topPostsArray.push(Museum);
const Grog2 = new Event("Closing Rager @ Grog", "Celebrate Grog's final month in Gainesville!", "nightlife");
topPostsArray.push(Grog2);
const Market2 = new Event("Vintage Market @ Midpoint Park", "Come check out the latest threads from your favorite local vendors", "market");
topPostsArray.push(Market2);
const Concert2 = new Event("Kanye West Concert @ Stephen O'Connell Center", "Kanye is back! Come watch him perform the much anticipated Yandhi, his next studio album coming soon", "concert");
topPostsArray.push(Concert2);
const Restaurant2 = new Event("Free Appetizer Night @ Piesanos", "We know how much you love those classic Piesanos rolls! Come stop by for some free Appetizers", "food");
topPostsArray.push(Restaurant2);
const Museum2 = new Event("Museum Night @ Harn Art Museum", "Come see our new exhibit, called 'Wagwan', and the artists behind its creation", "museum");
topPostsArray.push(Museum2);

tonightArray = topPostsArray;
weekendArray = topPostsArray;
likedArray = topPostsArray;



// Render
RenderAll();

function RenderAll() {
  const topPosts = ReactDOM.createRoot(document.getElementById('Top Posts'))
  topPosts.render(returnArrayComponents(topPostsArray));

  const tonightPosts = ReactDOM.createRoot(document.getElementById('Tonight'))
  tonightPosts.render(returnArrayComponents(tonightArray));

  const weekendPosts = ReactDOM.createRoot(document.getElementById('Weekend'))
  weekendPosts.render(returnArrayComponents(weekendArray));

  const likedPosts = ReactDOM.createRoot(document.getElementById('Liked'))
  likedPosts.render(returnArrayComponents(likedArray));
}
