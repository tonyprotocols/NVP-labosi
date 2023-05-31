const express = require("express");
const router = express.Router();
const projectController = require("../controllers/projectController");

// Project Routes

// Home
router.get("/", projectController.homepage);
router.get("/add", projectController.addProject);
router.post("/add", projectController.postProject);

router.get("/view/:id", projectController.viewProject);

router.get("/edit/:id", projectController.editProject);
router.put("/edit/:id", projectController.editPost);
router.delete("/edit/:id", projectController.deleteProject);

router.get("/addMember/:id", projectController.addProjectMember);
router.put("/addMember/:id", projectController.addProjectMemberPost);

module.exports = router;
