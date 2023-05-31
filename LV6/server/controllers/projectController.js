const Project = require("../models/Project");
const mongoose = require("mongoose");

// GET /
// HOMEPAGE

exports.homepage = async (req, res) => {
  const locals = {
    title: "Projects",
    description: "Projekti LV6 - NWP",
  };

  try {
    const projects = await Project.find({}).limit(22);
    res.render("index", { locals, projects });
  } catch (error) {
    console.log(error);
  }
};

// GET /
// New project form

exports.addProject = async (req, res) => {
  const locals = {
    title: "Add New Project",
    description: "Projekti LV6 - NWP",
  };

  res.render("project/add", locals);
};

// POST /
// Create new project form

exports.postProject = async (req, res) => {
  console.log(req.body);

  const newProject = new Project({
    name: req.body.name,
    price: req.body.price,
    description: req.body.description,
    startDate: req.body.startDate,
    endDate: req.body.endDate,
    jobsDone: req.body.jobsDone,
  });

  try {
    await Project.create(newProject);

    res.redirect("/");
  } catch (error) {
    console.log(error);
  }
};

// GET /
// Project Data

exports.viewProject = async (req, res) => {
  try {
    const project = await Project.findOne({ _id: req.params.id });

    const locals = {
      title: "View Project Data",
      description: "Projekti LV6 - NWP",
    };

    res.render("project/view", {
      locals,
      project,
    });
  } catch (error) {
    console.log(error);
  }
};

// GET /
// Edit Project Data

exports.editProject = async (req, res) => {
  try {
    const project = await Project.findOne({ _id: req.params.id });

    const locals = {
      title: "Edit Project Data",
      description: "Projekti LV6 - NWP",
    };

    res.render("project/edit", {
      locals,
      project,
    });
  } catch (error) {
    console.log(error);
  }
};

// POST /
// Update Project Data

exports.editPost = async (req, res) => {
  try {
    await Project.findByIdAndUpdate(req.params.id, {
      name: req.body.name,
      description: req.body.description,
      price: req.body.price,
      startDate: req.body.startDate,
      endDate: req.body.endDate,
      jobsDone: req.body.jobsDone,
    });

    res.redirect(`/edit/${req.params.id}`);
  } catch (error) {
    console.log(error);
  }
};

// DELETE /
// Delete Project

exports.deleteProject = async (req, res) => {
  try {
    await Project.deleteOne({ _id: req.params.id });
    res.redirect("/");
  } catch (error) {
    console.log(error);
  }
};

// GET /
// Edit Project Data

exports.addProjectMember = async (req, res) => {
  try {
    const project = await Project.findOne({ _id: req.params.id });

    const locals = {
      title: "Add Project Member",
      description: "Projekti LV6 - NWP",
    };

    res.render("project/addMember", {
      locals,
      project,
    });
  } catch (error) {
    console.log(error);
  }
};

// POST /
// Update Project Data

exports.addProjectMemberPost = async (req, res) => {
  try {
    await Project.findByIdAndUpdate(req.params.id, {
      $push: { members: req.body.members },
    });

    res.redirect(`/view/${req.params.id}`);
  } catch (error) {
    console.log(error);
  }
};
