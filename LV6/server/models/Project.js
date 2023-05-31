const mongoose = require("mongoose");

const Schema = mongoose.Schema;
const ProjectSchema = new Schema({
  name: {
    type: String,
    required: true,
  },
  price: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    required: true,
  },
  startDate: {
    type: String,
    required: true,
  },
  endDate: {
    type: String,
    required: true,
  },
  jobsDone: {
    type: String,
    required: true,
  },
  createdAt: {
    type: Date,
    default: Date.now(),
  },
  updatedAt: {
    type: Date,
    default: Date.now(),
  },
  members: [
    {
      type: String,
      default: null,
    },
  ],
});

module.exports = mongoose.model("Project", ProjectSchema);
