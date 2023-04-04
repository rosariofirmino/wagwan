import React, { Component } from "react";
import EventContainer from "./EventContainer";

// SAMPLE DATA

const topPosts = [
  {
    title: "Closing Rager @ Grog",
    description: "Celebrate Grog's final month in Gainesville!",
    category: "nightlife",
  },
  {
    title: "Vintage Market @ Midpoint Park",
    description:
      "Come check out the latest threads from your favorite local vendors",
    category: "market",
  },
  {
    title: "Kanye West Concert @ Stephen O'Connell Center",
    description:
      "Kanye is back! Come watch him perform the much anticipated Yandhi, his next studio album coming soon",
    category: "concert",
  },
  {
    title: "Free Appetizer Night @ Piesanos",
    description:
      "We know how much you love those classic Piesanos rolls! Come stop by for some free Appetizers",
    category: "food",
  },
  {
    title: "Museum Night @ Harn Art Museum",
    description:
      "Come see our new exhibit, called 'Wagwan', and the artists behind its creation",
    category: "museum",
  },
  {
    title: "Closing Rager @ Grog",
    description: "Celebrate Grog's final month in Gainesville!",
    category: "nightlife",
  },
];

// END SAMPLE DATA

export default class Homepage extends Component {
  render() {
    return (
      <div>
        <br />
        <h2>
          <strong>Top Wagwans</strong>
        </h2>
        <div class="d-flex flex-row flex-nowrap overflow-auto" id="Top Posts">
          <EventContainer data={topPosts} />
        </div>
        <br />
        <h2>
          <strong>Wagwan Tonight</strong>
        </h2>
        <div class="d-flex flex-row flex-nowrap overflow-auto" id="Tonight">
          <EventContainer data={topPosts} />
        </div>
        <br />
        <h2>
          <strong>Wagwan this Weekend</strong>
        </h2>
        <div class="d-flex flex-row flex-nowrap overflow-auto" id="Weekend">
          <EventContainer data={topPosts} />
        </div>
        <br />
        <h2>
          <strong>Your liked Wagwans</strong>
        </h2>
        <div class="d-flex flex-row flex-nowrap overflow-auto" id="Liked">
          <EventContainer data={topPosts} />
        </div>
      </div>
    );
  }
}
