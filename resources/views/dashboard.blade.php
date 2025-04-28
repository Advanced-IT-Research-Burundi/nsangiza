@extends('layouts.template')
@section("content")
<div class="header">
    <h1 class="page-title">Dashboard</h1>
    <hr class="bg bg-info">
    {{-- <div class="search-bar">
        <span class="search-icon"><i class="fas fa-search"></i></span>
        <input type="text" class="search-input" placeholder="Search files...">
    </div> --}}

    {{-- <div class="action-buttons">
        <button class="btn btn-outline">
            <span class="btn-icon"><i class="fas fa-folder-plus"></i></span>
            New Folder
        </button>
        <button class="btn btn-primary">
            <span class="btn-icon"><i class="fas fa-upload"></i></span>
            Upload Files
        </button>
    </div> --}}

    <div class="user-menu">
        <div class="user-avatar">JS</div>
        <div class="user-info">
            <div class="user-name">John Smith</div>
            <div class="user-email">john@example.com</div>
        </div>
    </div>
</div>

<div class="tabs">
    <div class="tab active">Upload Files</div>
</div>

<div class="upload-area">
    <div class="upload-icon">
        <i class="fas fa-cloud-upload-alt"></i>
    </div>
    <h3 class="upload-text">Drag & Drop files here or click to browse</h3>
    <input type="file" class="btn btn-primary" title="Browse Files"/>
</div>

<div class="files-header">
    <h2 class="section-title">Recent Files</h2>
    <div class="view-toggle">
        <button class="toggle-btn active"><i class="fas fa-th"></i></button>
        <button class="toggle-btn"><i class="fas fa-list"></i></button>
    </div>
</div>

<div class="files-grid">
    <div class="file-card">
        <div class="file-icon">
            <i class="fas fa-file-pdf"></i>
        </div>
        <div class="file-name">Project_Proposal.pdf</div>
        <div class="file-info">
            <span>2.4 MB</span>
            <span>Apr 9</span>
        </div>
    </div>

    <div class="file-card">
        <div class="file-icon image">
            <i class="fas fa-file-image"></i>
        </div>
        <div class="file-name">Team_Photo.jpg</div>
        <div class="file-info">
            <span>3.8 MB</span>
            <span>Apr 7</span>
        </div>
    </div>

    <div class="file-card">
        <div class="file-icon document">
            <i class="fas fa-file-word"></i>
        </div>
        <div class="file-name">Meeting_Notes.docx</div>
        <div class="file-info">
            <span>512 KB</span>
            <span>Apr 5</span>
        </div>
    </div>

    <div class="file-card">
        <div class="file-icon">
            <i class="fas fa-file-excel"></i>
        </div>
        <div class="file-name">Budget_2025.xlsx</div>
        <div class="file-info">
            <span>1.2 MB</span>
            <span>Apr 3</span>
        </div>
    </div>

    <div class="file-card">
        <div class="file-icon">
            <i class="fas fa-file-video"></i>
        </div>
        <div class="file-name">Product_Demo.mp4</div>
        <div class="file-info">
            <span>24.5 MB</span>
            <span>Apr 1</span>
        </div>
    </div>

    <div class="file-card">
        <div class="file-icon document">
            <i class="fas fa-file-code"></i>
        </div>
        <div class="file-name">main.js</div>
        <div class="file-info">
            <span>56 KB</span>
            <span>Mar 29</span>
        </div>
    </div>
</div>

<div class="activity-section">
    <div class="activity-header">
        <h2 class="section-title">Recent Activity</h2>
        <button class="btn btn-outline">View All</button>
    </div>

    <ul class="activity-list">
        <li class="activity-item">
            <div class="activity-icon upload">
                <i class="fas fa-upload"></i>
            </div>
            <div class="activity-details">
                <div class="activity-text">You <strong>uploaded</strong> Project_Proposal.pdf</div>
                <div class="activity-time">Today, 10:42 AM</div>
            </div>
        </li>

        <li class="activity-item">
            <div class="activity-icon share">
                <i class="fas fa-share-alt"></i>
            </div>
            <div class="activity-details">
                <div class="activity-text">You <strong>shared</strong> Budget_2025.xlsx with Sara Johnson</div>
                <div class="activity-time">Yesterday, 4:23 PM</div>
            </div>
        </li>

        <li class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="activity-details">
                <div class="activity-text">Mike Chen <strong>viewed</strong> Meeting_Notes.docx</div>
                <div class="activity-time">Yesterday, 2:15 PM</div>
            </div>
        </li>

        <li class="activity-item">
            <div class="activity-icon upload">
                <i class="fas fa-upload"></i>
            </div>
            <div class="activity-details">
                <div class="activity-text">You <strong>uploaded</strong> 3 files to Product Design</div>
                <div class="activity-time">Apr 8, 11:03 AM</div>
            </div>
        </li>
    </ul>
</div>
@endsection
