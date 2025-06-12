<!-- Notes Component -->
<div id="notes-content" class="tool-content">
    <div class="notes-workspace">
        <div class="notes-sidebar">
            <div class="sidebar-header">
                <h3 class="sidebar-title">Notes</h3>
                <input type="text" id="searchNotesInput" placeholder="Search notes..." class="note-search-input">
                <div class="notes-filter">
                    <button id="showAllNotesBtn" class="filter-btn active" onclick="toggleNotesFilter('all')">All</button>
                    <button id="showArchivedNotesBtn" class="filter-btn" onclick="toggleNotesFilter('archived')">Archive</button>
                    <button id="showPinnedNotesBtn" class="filter-btn" onclick="toggleNotesFilter('pinned')">Pinned</button>
                </div>
            </div>
            
            <div class="notes-categories">
                <h3>Categories</h3>
                <div class="category-list" id="categoryList">
                    <!-- Categories will be populated here -->
                </div>
                <button class="add-category-btn" onclick="showAddCategoryModal()">
                    <i class="fas fa-plus"></i> Add Category
                </button>
            </div>
            
            <div class="notes-list" id="notesList">
                <!-- Notes will be populated here -->
            </div>
        </div>

        <div class="notes-editor main-content-area">
            <div class="editor-title-row">
                <input type="text" id="noteTitle" placeholder="Note Title" class="note-title-input super-large" style="text-align:center;">
            </div>
            <div class="editor-fields-row">
                <select id="noteCategory" class="note-category-select">
                    <option value="">Select Category</option>
                </select>
                <input type="text" id="noteTags" placeholder="Tags (comma separated)" class="note-detail-input">
                <button class="details-modal-btn" onclick="openDetailsModal()">More</button>
            </div>
            <div class="editor-toolbar-row">
                <div class="editor-toolbar modern-toolbar">
                    <button class="toolbar-btn" onclick="execCommand('bold')" title="Bold">
                        <i class="fas fa-bold"></i>
                    </button>
                    <button class="toolbar-btn" onclick="execCommand('italic')" title="Italic">
                        <i class="fas fa-italic"></i>
                    </button>
                    <button class="toolbar-btn" onclick="execCommand('underline')" title="Underline">
                        <i class="fas fa-underline"></i>
                    </button>
                    <button class="toolbar-btn" onclick="execCommand('strikeThrough')" title="Strike Through">
                        <i class="fas fa-strikethrough"></i>
                    </button>
                    <span class="toolbar-divider"></span>
                    <button class="toolbar-btn" onclick="execCommand('justifyLeft')" title="Align Left">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <button class="toolbar-btn" onclick="execCommand('justifyCenter')" title="Align Center">
                        <i class="fas fa-align-center"></i>
                    </button>
                    <button class="toolbar-btn" onclick="execCommand('justifyRight')" title="Align Right">
                        <i class="fas fa-align-right"></i>
                    </button>
                    <span class="toolbar-divider"></span>
                    <button class="toolbar-btn" onclick="execCommand('insertUnorderedList')" title="Bullet List">
                        <i class="fas fa-list-ul"></i>
                    </button>
                    <button class="toolbar-btn" onclick="execCommand('insertOrderedList')" title="Numbered List">
                        <i class="fas fa-list-ol"></i>
                    </button>
                    <span class="toolbar-divider"></span>
                    <button class="toolbar-btn" onclick="addChecklistItem()" title="Add Checklist Item">
                        <i class="fas fa-check-square"></i>
                    </button>
                    <button class="toolbar-btn" onclick="insertLink()" title="Insert Link">
                        <i class="fas fa-link"></i>
                    </button>
                    <button class="toolbar-btn" onclick="showImageUploadModal()" title="Insert Image">
                        <i class="fas fa-image"></i>
                    </button>
                </div>
            </div>
            <div class="editor-content-row">
                <div id="noteContent" class="note-content" contenteditable="true"></div>
            </div>
            <div class="editor-footer-row">
                <div class="note-meta">
                    <span id="lastSaved">Last saved: Never</span>
                    <span id="wordCount">Words: 0</span>
                    <span id="reminderInfo"></span>
                </div>
                <div class="editor-actions">
                    <button class="secondary-btn" id="newNoteBtn">New</button>
                    <button class="secondary-btn" id="templateNoteBtn">Template</button>
                    <button class="archive-btn" id="archiveNoteBtn">Archive</button>
                    <button class="delete-btn" id="deleteNoteBtn">Delete</button>
                    <button class="primary-btn" id="saveNoteBtn">Save</button>
                    <button class="secondary-btn" id="exportNotesBtn">Export</button>
                    <button class="secondary-btn" id="importNotesBtn">Import</button>
                    <button class="secondary-btn" id="setReminderBtn">Reminder</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="modal">
    <div class="modal-content">
        <h3>Add New Category</h3>
        <input type="text" id="newCategoryName" placeholder="Category Name">
        <input type="color" id="newCategoryColor" value="#3498db">
        <div class="modal-actions">
            <button class="secondary-btn" onclick="closeAddCategoryModal()">Cancel</button>
            <button class="primary-btn" onclick="addNewCategory()">Add</button>
        </div>
    </div>
</div>

<!-- Image Upload Modal -->
<div id="imageUploadModal" class="modal">
    <div class="modal-content">
        <h3>Insert Image</h3>
        <div class="upload-methods">
            <div class="upload-method">
                <h4>Upload from device</h4>
                <input type="file" id="imageFileInput" accept="image/*">
            </div>
            <div class="upload-method">
                <h4>Paste image URL</h4>
                <input type="text" id="imageUrlInput" placeholder="https://example.com/image.jpg">
            </div>
            <div class="drag-drop-area" id="dragDropArea">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drag & drop image here</p>
            </div>
        </div>
        <div class="modal-actions">
            <button class="secondary-btn" onclick="closeImageUploadModal()">Cancel</button>
            <button class="primary-btn" onclick="insertImage()">Insert</button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="modal">
    <div class="modal-content">
        <h3>Delete Note</h3>
        <p>Are you sure you want to delete this note? This action cannot be undone.</p>
        <div class="modal-actions">
            <button class="secondary-btn" onclick="closeDeleteConfirmModal()">Cancel</button>
            <button class="delete-btn" onclick="deleteNote()">Delete</button>
        </div>
    </div>
</div>

<!-- Reminder Modal -->
<div id="reminderModal" class="modal">
    <div class="modal-content">
        <h3>Set Reminder</h3>
        <input type="datetime-local" id="reminderDateTime">
        <div class="modal-actions">
            <button class="secondary-btn" onclick="closeReminderModal()">Cancel</button>
            <button class="primary-btn" onclick="saveReminder()">Set</button>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="modal">
    <div class="modal-content">
        <h3>Import Notes</h3>
        <input type="file" id="importFileInput" accept=".json,.csv">
        <div class="modal-actions">
            <button class="secondary-btn" onclick="closeImportModal()">Cancel</button>
            <button class="primary-btn" onclick="importNotes()">Import</button>
        </div>
    </div>
</div>

<!-- Template Modal -->
<div id="templateModal" class="modal">
    <div class="modal-content">
        <h3>Choose Template</h3>
        <button class="secondary-btn" onclick="applyTemplate('expense')">Expense</button>
        <button class="secondary-btn" onclick="applyTemplate('vocabulary')">Vocabulary</button>
        <button class="secondary-btn" onclick="applyTemplate('todo')">To-Do</button>
        <button class="secondary-btn" onclick="closeTemplateModal()">Cancel</button>
    </div>
</div>

<!-- More Details Modal -->
<div id="detailsModal" class="modal">
    <div class="modal-content">
        <h3>More Details</h3>
        <input type="number" id="noteAmount" placeholder="Amount (optional)" class="note-detail-input">
        <input type="date" id="noteDate" class="note-detail-input">
        <button id="pinNoteBtn" class="secondary-btn pin-btn" title="Pin/Unpin Note"><i class="fas fa-thumbtack"></i> Pin</button>
        <input type="color" id="noteColor" title="Note Color" class="note-color-input">
        <div class="modal-actions">
            <button class="secondary-btn" onclick="closeDetailsModal()">Close</button>
        </div>
    </div>
</div>

<script>
// Set up event listeners for the note buttons
document.addEventListener('DOMContentLoaded', function() {
    // Initialize note buttons when they exist
    const saveBtn = document.getElementById('saveNoteBtn');
    if (saveBtn) {
        saveBtn.addEventListener('click', function() {
            if (typeof saveNote === 'function') saveNote();
        });
    }
    
    const newBtn = document.getElementById('newNoteBtn');
    if (newBtn) {
        newBtn.addEventListener('click', function() {
            if (typeof createNewNote === 'function') createNewNote();
        });
    }
    
    const deleteBtn = document.getElementById('deleteNoteBtn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            if (typeof deleteNoteWithConfirmation === 'function') deleteNoteWithConfirmation();
        });
    }
    
    const archiveBtn = document.getElementById('archiveNoteBtn');
    if (archiveBtn) {
        archiveBtn.addEventListener('click', function() {
            if (typeof toggleArchiveNote === 'function') toggleArchiveNote();
        });
    }

    // Close modal buttons
    const closeDeleteModalBtn = document.querySelector('#deleteConfirmModal .secondary-btn');
    if (closeDeleteModalBtn) {
        closeDeleteModalBtn.addEventListener('click', function() {
            document.getElementById('deleteConfirmModal').style.display = 'none';
        });
    }

    document.getElementById('searchNotesInput').addEventListener('input', function() {
        searchQuery = this.value.toLowerCase();
        renderNotesList();
    });
    document.getElementById('pinNoteBtn').addEventListener('click', function() {
        if (!currentNote) return;
        currentNote.pinned = !currentNote.pinned;
        saveNote();
        this.classList.toggle('active', currentNote.pinned);
    });
    document.getElementById('setReminderBtn').addEventListener('click', function() {
        document.getElementById('reminderModal').style.display = 'flex';
    });
    document.getElementById('exportNotesBtn').addEventListener('click', exportNotes);
    document.getElementById('importNotesBtn').addEventListener('click', function() {
        document.getElementById('importModal').style.display = 'flex';
    });
    document.getElementById('templateNoteBtn').addEventListener('click', function() {
        document.getElementById('templateModal').style.display = 'flex';
    });
    document.getElementById('noteColor').addEventListener('input', function() {
        if (currentNote) {
            currentNote.color = this.value;
            saveNote();
        }
    });
});

// This function will be implemented in notes.js
function toggleArchiveNote() {
    if (typeof window.toggleArchiveNote === 'function') {
        window.toggleArchiveNote();
    } else {
        console.error('toggleArchiveNote function not found');
    }
}

// Initialize when this component is shown
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('notes-content') && 
        document.getElementById('notes-content').style.display === 'block') {
        if (typeof initializeNotes === 'function') {
            initializeNotes();
        }
    }
});

function openDetailsModal() {
    document.getElementById('detailsModal').style.display = 'flex';
}
function closeDetailsModal() {
    document.getElementById('detailsModal').style.display = 'none';
}
</script>

<style>
.notes-workspace {
    display: flex;
    gap: 1.5rem;
    height: calc(100vh - 180px);
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow: hidden;
}

.notes-sidebar {
    width: 300px;
    background: #f8f9fa;
    border-right: 1px solid #eee;
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    padding: 1.5rem 1.5rem 0.5rem;
    border-bottom: 1px solid #eee;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.sidebar-header h3 {
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-size: 1.3rem;
}

.notes-categories {
    padding: 1.5rem;
    border-bottom: 1px solid #eee;
}

.notes-categories h3 {
    margin-bottom: 1rem;
    color: #2c3e50;
    font-size: 1.1rem;
}

.category-list {
    margin-bottom: 1rem;
}

.category-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

.category-item:hover {
    background: rgba(0,0,0,0.05);
}

.category-item.active {
    background: #e3f2fd;
}

.category-color {
    width: 12px;
    height: 12px;
    border-radius: 3px;
}

.add-category-btn {
    width: 100%;
    padding: 0.75rem;
    border: 1px dashed #ccc;
    border-radius: 6px;
    background: transparent;
    color: #666;
    cursor: pointer;
    transition: all 0.2s;
}

.add-category-btn:hover {
    border-color: #3498db;
    color: #3498db;
}

.notes-filter {
    display: flex;
    gap: 0.5rem;
}

.filter-btn {
    flex: 1;
    padding: 0.5rem 1rem;
    background: #f1f1f1;
    border: none;
    border-radius: 4px;
    color: #666;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.filter-btn.active {
    background: #3498db;
    color: white;
}

.notes-list {
    flex: 1;
    overflow-y: auto;
    padding: 1.5rem;
}

.note-item {
    padding: 1rem;
    border-radius: 8px;
    background: white;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
}

.note-item:hover {
    transform: translateX(4px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.note-item.active {
    background: #e3f2fd;
}

.note-item.archived {
    opacity: 0.7;
    background: #f8f8f8;
    border-left: 3px solid #95a5a6;
}

.note-item.pinned {
    background: #f39c12;
    color: white;
}

.note-item-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
    padding-right: 60px;
}

.note-item-meta {
    font-size: 0.8rem;
    color: #666;
    display: flex;
    justify-content: space-between;
}

.note-actions {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    display: flex;
    gap: 0.25rem;
    opacity: 0;
    transition: opacity 0.2s;
}

.note-item:hover .note-actions {
    opacity: 1;
}

.note-action-btn {
    width: 28px;
    height: 28px;
    border-radius: 4px;
    border: none;
    background: transparent;
    color: #666;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.note-action-btn:hover {
    background: rgba(0,0,0,0.05);
}

.note-action-btn.archive-btn:hover {
    color: #7f8c8d;
}

.note-action-btn.delete-btn:hover {
    color: #e74c3c;
}

.notes-editor {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
}

.editor-section {
    margin-bottom: 1.2rem;
    background: #f9fbfd;
    padding: 1.1rem 1.2rem;
    border-radius: 10px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.03);
}

.details-row {
    display: flex;
    gap: 1rem;
    align-items: center;
    border-bottom: 1px solid #e3e8ee;
    background: #f4f7fa;
    margin-bottom: 0.5rem;
    padding-bottom: 0.7rem;
}

.details-extra {
    display: flex;
    gap: 1rem;
    align-items: center;
    background: #f4f7fa;
    margin-bottom: 0.5rem;
    padding-bottom: 0.7rem;
    border-bottom: 1px solid #e3e8ee;
}

.details-toggle-btn {
    background: none;
    border: none;
    color: #3498db;
    font-size: 1rem;
    cursor: pointer;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    transition: background 0.2s;
}

.details-toggle-btn:hover {
    background: #e3f2fd;
}

.toolbar-row {
    background: #f4f7fa;
    border-radius: 10px;
    margin-bottom: 0.5rem;
    padding: 0.7rem 1.2rem;
}

.editor-toolbar {
    margin-bottom: 0;
    font-size: 1.1rem;
}

.note-title-input.large {
    font-size: 2.1rem;
    font-weight: 800;
    padding: 1.2rem 1.5rem;
    border-radius: 12px;
    border: 1.5px solid #dbeafe;
    width: 100%;
    margin-bottom: 0.5rem;
    background: #fff;
}

.note-detail-input, .note-category-select {
    padding: 0.7rem 1.1rem;
    border: 1px solid #eee;
    border-radius: 7px;
    font-size: 1.05rem;
    min-width: 140px;
    max-width: 180px;
    background: #fff;
}

.pin-btn {
    font-size: 1.1rem;
    padding: 0.6rem 1rem;
    border-radius: 7px;
}

.note-color-input {
    width: 36px;
    height: 36px;
    border: none;
    background: transparent;
    cursor: pointer;
    margin-left: 0.5rem;
}

.note-content {
    font-size: 1.15rem;
    min-height: 350px;
    padding: 1.2rem;
    border-radius: 8px;
    border: 1.5px solid #dbeafe;
    margin-bottom: 1rem;
    background: #fff;
}

.editor-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 0.5rem;
    font-size: 1.05rem;
    background: none;
    box-shadow: none;
    padding: 0;
}

.note-meta {
    color: #888;
    font-size: 0.95rem;
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.editor-actions {
    display: flex;
    gap: 0.7rem;
    align-items: center;
}

.editor-actions button {
    font-size: 1.05rem;
    padding: 0.7rem 1.3rem;
    border-radius: 8px;
}

.primary-btn, .secondary-btn, .delete-btn, .archive-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    border: none;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
}

.primary-btn {
    background: #3498db;
    color: white;
}

.primary-btn:hover {
    background: #2980b9;
}

.secondary-btn {
    background: #f8f9fa;
    color: #666;
    border: 1px solid #eee;
}

.secondary-btn:hover {
    background: #e9ecef;
}

.delete-btn {
    background: #e74c3c;
    color: white;
}

.delete-btn:hover {
    background: #c0392b;
}

.archive-btn {
    background: #95a5a6;
    color: white;
}

.archive-btn:hover {
    background: #7f8c8d;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    width: 100%;
    max-width: 400px;
}

.modal-content h3 {
    margin-bottom: 1.5rem;
    color: #2c3e50;
}

.modal-content p {
    margin-bottom: 1.5rem;
    color: #666;
}

.modal-content input[type="text"] {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #eee;
    border-radius: 6px;
    margin-bottom: 1rem;
}

.modal-content input[type="color"] {
    width: 100%;
    height: 40px;
    padding: 0;
    border: 1px solid #eee;
    border-radius: 6px;
    margin-bottom: 1.5rem;
}

.modal-content input[type="file"] {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #eee;
    border-radius: 6px;
    margin-bottom: 1rem;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.upload-methods {
    margin-bottom: 1.5rem;
}

.upload-method {
    margin-bottom: 1rem;
}

.upload-method h4 {
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-size: 1rem;
}

.drag-drop-area {
    padding: 2rem;
    border: 2px dashed #ccc;
    border-radius: 6px;
    text-align: center;
    color: #666;
    transition: all 0.2s;
    margin-top: 1rem;
}

.drag-drop-area.drag-over {
    background: #e3f2fd;
    border-color: #3498db;
}

.drag-drop-area i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

/* Checklist Styles */
.checklist-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0.5rem 0;
}

.checklist-item input[type="checkbox"] {
    width: 18px;
    height: 18px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .notes-workspace {
        flex-direction: column;
    }

    .notes-sidebar {
        width: 100%;
        height: auto;
        border-right: none;
        border-bottom: 1px solid #eee;
    }

    .notes-editor {
        height: 0;
        flex: 1;
    }
}

.note-item.pinned .note-item-title {
    color: #e67e22;
}
.tag {
    background: #e3f2fd;
    color: #3498db;
    border-radius: 3px;
    padding: 0 4px;
    margin-right: 2px;
    font-size: 0.85em;
}

.sidebar-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #2c3e50;
}
.note-search-input {
    width: 100%;
    padding: 0.7rem 1rem;
    font-size: 1.1rem;
    border-radius: 8px;
    border: 1px solid #eee;
    margin-bottom: 1rem;
}
.editor-header {
    margin-bottom: 0.5rem;
}
.note-title-input.large {
    font-size: 1.7rem;
    font-weight: 700;
    padding: 1rem 1.2rem;
    border-radius: 10px;
    border: 1.5px solid #dbeafe;
    width: 100%;
    margin-bottom: 0.5rem;
}
.editor-details-section {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}
.note-detail-input {
    padding: 0.6rem 1rem;
    border: 1px solid #eee;
    border-radius: 7px;
    font-size: 1rem;
    min-width: 140px;
    max-width: 180px;
}
.note-category-select {
    padding: 0.6rem 1rem;
    border: 1px solid #eee;
    border-radius: 7px;
    font-size: 1rem;
    min-width: 160px;
}
.pin-btn {
    font-size: 1.2rem;
    padding: 0.6rem 0.9rem;
    border-radius: 7px;
}
.note-color-input {
    width: 38px;
    height: 38px;
    border: none;
    background: transparent;
    cursor: pointer;
    margin-left: 0.5rem;
}
.editor-toolbar {
    margin-bottom: 1rem;
    font-size: 1.1rem;
}
.note-content {
    font-size: 1.15rem;
    min-height: 350px;
    padding: 1.2rem;
    border-radius: 8px;
    border: 1.5px solid #dbeafe;
    margin-bottom: 1rem;
}
.editor-footer {
    margin-top: 0.5rem;
    font-size: 1.05rem;
}
.note-meta span {
    font-size: 1rem;
}
.editor-actions button {
    font-size: 1.05rem;
    padding: 0.7rem 1.3rem;
    border-radius: 8px;
}
@media (max-width: 1200px) {
    .editor-details-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
.main-content-area {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    padding: 2.2rem 2.5rem 1.5rem 2.5rem;
    margin: 1.5rem 0;
}
.editor-title-row {
    margin-bottom: 1.5rem;
}
.super-large {
    font-size: 2.3rem;
    font-weight: 900;
    padding: 1.3rem 1.5rem;
    border-radius: 14px;
    border: 1.5px solid #dbeafe;
    width: 100%;
    background: #fff;
    margin-bottom: 0;
}
.editor-fields-row {
    display: flex;
    gap: 1.2rem;
    align-items: center;
    margin-bottom: 1.5rem;
}
.details-modal-btn {
    background: none;
    border: 1px solid #dbeafe;
    color: #3498db;
    font-size: 1.05rem;
    cursor: pointer;
    padding: 0.7rem 1.2rem;
    border-radius: 8px;
    transition: background 0.2s;
}
.details-modal-btn:hover {
    background: #e3f2fd;
}
.editor-toolbar-row {
    margin-bottom: 1.2rem;
}
.editor-toolbar {
    font-size: 1.1rem;
    background: none;
    border: none;
    box-shadow: none;
    padding: 0;
}
.editor-content-row {
    margin-bottom: 1.5rem;
}
.note-content {
    font-size: 1.15rem;
    min-height: 300px;
    padding: 1.2rem;
    border-radius: 10px;
    border: 1.5px solid #dbeafe;
    background: #fff;
}
.editor-footer-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 1.5rem;
    font-size: 1.05rem;
    background: none;
    box-shadow: none;
    padding: 0;
}
.note-meta {
    color: #888;
    font-size: 0.95rem;
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}
.editor-actions {
    display: flex;
    gap: 0.7rem;
    align-items: center;
}
.editor-actions button {
    font-size: 1.05rem;
    padding: 0.7rem 1.3rem;
    border-radius: 8px;
}
/* Modal for More Details */
#detailsModal.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}
#detailsModal .modal-content {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    width: 100%;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
#detailsModal .modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}
@media (max-width: 900px) {
    .main-content-area {
        padding: 1.2rem 0.5rem 1rem 0.5rem;
    }
    .editor-fields-row, .editor-actions {
        flex-direction: column;
        align-items: stretch;
        gap: 0.7rem;
    }
    .editor-footer-row {
        flex-direction: column;
        align-items: stretch;
        gap: 0.7rem;
    }
}
.modern-toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.2rem;
    background: #f7fafd;
    border-radius: 8px;
    padding: 0.5rem 0.7rem;
    box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    margin-bottom: 1.2rem;
}
.toolbar-btn {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background: none;
    border-radius: 50%;
    color: #444;
    font-size: 1.25rem;
    margin: 0 0.1rem;
    transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    outline: none;
    position: relative;
}
.toolbar-btn:hover, .toolbar-btn:focus {
    background: #e3f2fd;
    color: #1976d2;
    box-shadow: 0 2px 8px rgba(52,152,219,0.08);
}
.toolbar-btn:active {
    background: #bbdefb;
    color: #1565c0;
}
.toolbar-divider {
    display: inline-block;
    width: 1.5px;
    height: 26px;
    background: #e0e7ef;
    margin: 0 0.5rem;
    border-radius: 1px;
}
@media (max-width: 700px) {
    .modern-toolbar {
        flex-wrap: wrap;
        gap: 0.1rem;
        padding: 0.3rem 0.2rem;
    }
    .toolbar-btn {
        width: 34px;
        height: 34px;
        font-size: 1.1rem;
    }
    .toolbar-divider {
        height: 18px;
        margin: 0 0.2rem;
    }
}
</style>

<script>
let currentNote = null;
let notes = [];
let categories = [];
let currentFilter = 'all';
let searchQuery = '';
let noteHistory = [];
let reminderTimeout = null;

document.addEventListener('DOMContentLoaded', function() {
    loadFromLocalStorage();
    renderCategories();
    renderNotesList();
    initializeEditor();
    setupImageHandling();
});

function initializeEditor() {
    const noteContent = document.getElementById('noteContent');
    
    noteContent.addEventListener('input', function() {
        updateWordCount();
        autoSave();
    });

    // Handle paste events for images
    noteContent.addEventListener('paste', handlePaste);
    
    // Initialize with empty note
    createNewNote();
}

function setupImageHandling() {
    // Setup drag and drop for images
    const dragDropArea = document.getElementById('dragDropArea');
    const noteContent = document.getElementById('noteContent');
    
    // Setup file input
    const imageFileInput = document.getElementById('imageFileInput');
    imageFileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            handleImageFile(this.files[0]);
        }
    });
    
    // Setup drag and drop
    dragDropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('drag-over');
    });
    
    dragDropArea.addEventListener('dragleave', function(e) {
        this.classList.remove('drag-over');
    });
    
    dragDropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('drag-over');
        
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            handleImageFile(e.dataTransfer.files[0]);
        }
    });
    
    // Setup note content area to accept dropped images
    noteContent.addEventListener('dragover', function(e) {
        e.preventDefault();
    });
    
    noteContent.addEventListener('drop', function(e) {
        e.preventDefault();
        
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            handleImageFile(e.dataTransfer.files[0]);
        }
    });
}

function handlePaste(e) {
    // Check if clipboard contains image data
    const items = (e.clipboardData || e.originalEvent.clipboardData).items;
    
    for (let i = 0; i < items.length; i++) {
        if (items[i].type.indexOf('image') !== -1) {
            const file = items[i].getAsFile();
            handleImageFile(file);
            e.preventDefault();
            break;
        }
    }
}

function handleImageFile(file) {
    if (!file || !file.type.match(/image.*/)) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        insertImageAtCursor(e.target.result);
    };
    reader.readAsDataURL(file);
    
    // Close modal if open
    closeImageUploadModal();
}

function insertImageAtCursor(imageUrl) {
    const img = document.createElement('img');
    img.src = imageUrl;
    img.style.maxWidth = '100%';
    
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        range.insertNode(img);
        
        // Move cursor after image
        range.setStartAfter(img);
        range.setEndAfter(img);
        selection.removeAllRanges();
        selection.addRange(range);
    } else {
        document.getElementById('noteContent').appendChild(img);
    }
}

function showImageUploadModal() {
    document.getElementById('imageUploadModal').style.display = 'flex';
    document.getElementById('imageUrlInput').value = '';
    document.getElementById('imageFileInput').value = '';
}

function closeImageUploadModal() {
    document.getElementById('imageUploadModal').style.display = 'none';
}

function insertImage() {
    const url = document.getElementById('imageUrlInput').value.trim();
    const fileInput = document.getElementById('imageFileInput');
    
    if (url) {
        insertImageAtCursor(url);
        closeImageUploadModal();
    } else if (fileInput.files && fileInput.files[0]) {
        handleImageFile(fileInput.files[0]);
    } else {
        alert('Please provide an image URL or select a file.');
    }
}

function execCommand(command, value = null) {
    document.execCommand(command, false, value);
    document.getElementById('noteContent').focus();
}

function addChecklistItem() {
    const checklistItem = document.createElement('div');
    checklistItem.className = 'checklist-item';
    checklistItem.innerHTML = `
        <input type="checkbox">
        <span contenteditable="true">New item</span>
    `;
    document.getElementById('noteContent').appendChild(checklistItem);
}

function insertLink() {
    const url = prompt('Enter URL:');
    if (url) {
        execCommand('createLink', url);
    }
}

function updateWordCount() {
    const content = document.getElementById('noteContent').innerText;
    const wordCount = content.trim() ? content.trim().split(/\s+/).length : 0;
    document.getElementById('wordCount').textContent = `Words: ${wordCount}`;
}

function autoSave() {
    if (currentNote) {
        saveNote(true);
    }
}

function createNewNote() {
    currentNote = {
        id: Date.now(),
        title: '',
        content: '',
        category: '',
        tags: [],
        amount: '',
        date: '',
        pinned: false,
        color: '#ffffff',
        reminder: '',
        attachments: [],
        archived: false,
        createdAt: new Date().toISOString(),
        updatedAt: new Date().toISOString(),
        history: []
    };
    
    document.getElementById('noteTitle').value = '';
    document.getElementById('noteCategory').value = '';
    document.getElementById('noteContent').innerHTML = '';
    document.getElementById('noteTags').value = '';
    document.getElementById('noteAmount').value = '';
    document.getElementById('noteDate').value = '';
    document.getElementById('pinNoteBtn').classList.remove('active');
    document.getElementById('noteColor').value = '#ffffff';
    document.getElementById('reminderInfo').textContent = '';
    document.getElementById('lastSaved').textContent = 'Last saved: Never';
    document.getElementById('archiveButtonText').textContent = 'Archive';
    updateWordCount();
}

function saveNote(isAutoSave = false) {
    if (!currentNote) return;
    
    // Save previous version for history
    if (!isAutoSave) {
        if (!currentNote.history) currentNote.history = [];
        currentNote.history.push({
            title: currentNote.title,
            content: currentNote.content,
            updatedAt: currentNote.updatedAt
        });
    }
    currentNote.title = document.getElementById('noteTitle').value;
    currentNote.content = document.getElementById('noteContent').innerHTML;
    currentNote.category = document.getElementById('noteCategory').value;
    currentNote.tags = document.getElementById('noteTags').value.split(',').map(t => t.trim()).filter(Boolean);
    currentNote.amount = document.getElementById('noteAmount').value;
    currentNote.date = document.getElementById('noteDate').value;
    currentNote.color = document.getElementById('noteColor').value;
    currentNote.updatedAt = new Date().toISOString();
    
    const existingNoteIndex = notes.findIndex(note => note.id === currentNote.id);
    if (existingNoteIndex !== -1) {
        notes[existingNoteIndex] = currentNote;
    } else {
        notes.push(currentNote);
    }
    
    saveToLocalStorage();
    renderNotesList();
    
    if (!isAutoSave) {
        showNotification('Note saved successfully!');
    }
    
    document.getElementById('lastSaved').textContent = `Last saved: ${new Date().toLocaleTimeString()}`;
}

function deleteNoteWithConfirmation(noteId = null) {
    if (noteId) {
        // If called from note item
        const note = notes.find(n => n.id === noteId);
        if (note) {
            currentNote = note;
        }
    }
    
    if (!currentNote) return;
    
    document.getElementById('deleteConfirmModal').style.display = 'flex';
}

function closeDeleteConfirmModal() {
    document.getElementById('deleteConfirmModal').style.display = 'none';
}

function deleteNote() {
    if (!currentNote) return;
    
    notes = notes.filter(note => note.id !== currentNote.id);
    saveToLocalStorage();
    renderNotesList();
    
    // If we're viewing the deleted note, create a new one
    if (document.getElementById('noteTitle').value) {
        createNewNote();
    }
    
    closeDeleteConfirmModal();
    showNotification('Note deleted successfully!');
}

function toggleArchiveNote(noteId = null) {
    // If called from note item
    if (noteId) {
        const noteIndex = notes.findIndex(n => n.id === noteId);
        if (noteIndex !== -1) {
            notes[noteIndex].archived = !notes[noteIndex].archived;
            
            // If this is the current note, update the button text
            if (currentNote && currentNote.id === noteId) {
                currentNote.archived = notes[noteIndex].archived;
                document.getElementById('archiveButtonText').textContent = 
                    currentNote.archived ? 'Unarchive' : 'Archive';
            }
            
            saveToLocalStorage();
            renderNotesList();
            showNotification(notes[noteIndex].archived ? 'Note archived!' : 'Note unarchived!');
            return;
        }
    }
    
    // If called from main editor
    if (!currentNote) return;
    
    currentNote.archived = !currentNote.archived;
    
    // Update button text
    document.getElementById('archiveButtonText').textContent = 
        currentNote.archived ? 'Unarchive' : 'Archive';
    
    saveNote();
    showNotification(currentNote.archived ? 'Note archived!' : 'Note unarchived!');
}

function toggleNotesFilter(filter) {
    currentFilter = filter;
    
    // Update active button
    document.getElementById('showAllNotesBtn').classList.toggle('active', filter === 'all');
    document.getElementById('showArchivedNotesBtn').classList.toggle('active', filter === 'archived');
    document.getElementById('showPinnedNotesBtn').classList.toggle('active', filter === 'pinned');
    
    renderNotesList();
}

function loadNote(noteId) {
    const note = notes.find(n => n.id === noteId);
    if (note) {
        currentNote = note;
        document.getElementById('noteTitle').value = note.title;
        document.getElementById('noteCategory').value = note.category;
        document.getElementById('noteContent').innerHTML = note.content;
        document.getElementById('noteTags').value = (note.tags || []).join(', ');
        document.getElementById('noteAmount').value = note.amount || '';
        document.getElementById('noteDate').value = note.date || '';
        document.getElementById('pinNoteBtn').classList.toggle('active', note.pinned);
        document.getElementById('noteColor').value = note.color || '#ffffff';
        document.getElementById('reminderInfo').textContent = note.reminder ? `Reminder: ${new Date(note.reminder).toLocaleString()}` : '';
        document.getElementById('lastSaved').textContent = `Last saved: ${new Date(note.updatedAt).toLocaleTimeString()}`;
        document.getElementById('archiveButtonText').textContent = note.archived ? 'Unarchive' : 'Archive';
        updateWordCount();
        
        // Update active state in list
        document.querySelectorAll('.note-item').forEach(item => {
            item.classList.toggle('active', item.dataset.id === noteId.toString());
        });
    }
}

function showAddCategoryModal() {
    document.getElementById('addCategoryModal').style.display = 'flex';
}

function closeAddCategoryModal() {
    document.getElementById('addCategoryModal').style.display = 'none';
}

function addNewCategory() {
    const name = document.getElementById('newCategoryName').value.trim();
    const color = document.getElementById('newCategoryColor').value;
    
    if (name) {
        categories.push({
            id: Date.now(),
            name,
            color
        });
        
        saveToLocalStorage();
        renderCategories();
        closeAddCategoryModal();
        document.getElementById('newCategoryName').value = '';
    }
}

function renderCategories() {
    const categoryList = document.getElementById('categoryList');
    const categorySelect = document.getElementById('noteCategory');
    
    // Clear existing options
    categoryList.innerHTML = '';
    categorySelect.innerHTML = '<option value="">Select Category</option>';
    
    categories.forEach(category => {
        // Add to sidebar list
        const categoryItem = document.createElement('div');
        categoryItem.className = 'category-item';
        categoryItem.innerHTML = `
            <div class="category-color" style="background: ${category.color}"></div>
            <span>${category.name}</span>
        `;
        categoryList.appendChild(categoryItem);
        
        // Add to select dropdown
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        categorySelect.appendChild(option);
    });
}

function renderNotesList() {
    const notesList = document.getElementById('notesList');
    notesList.innerHTML = '';
    
    // Filter notes based on current filter and search
    let filteredNotes = notes.filter(note => {
        if (currentFilter === 'all') return !note.archived;
        if (currentFilter === 'archived') return note.archived;
        if (currentFilter === 'pinned') return note.pinned && !note.archived;
        return true;
    });
    if (searchQuery) {
        filteredNotes = filteredNotes.filter(note => {
            const tags = (note.tags || []).join(' ');
            return (
                (note.title && note.title.toLowerCase().includes(searchQuery)) ||
                (note.content && note.content.toLowerCase().includes(searchQuery)) ||
                (tags && tags.toLowerCase().includes(searchQuery)) ||
                (note.amount && note.amount.toString().includes(searchQuery))
            );
        });
    }
    // Pinned notes first
    filteredNotes.sort((a, b) => {
        if (b.pinned !== a.pinned) return b.pinned - a.pinned;
        return new Date(b.updatedAt) - new Date(a.updatedAt);
    });
    filteredNotes.forEach(note => {
        const noteItem = document.createElement('div');
        noteItem.className = 'note-item';
        if (note.archived) noteItem.classList.add('archived');
        if (note.pinned) noteItem.classList.add('pinned');
        if (currentNote && currentNote.id === note.id) noteItem.classList.add('active');
        noteItem.dataset.id = note.id;
        const category = categories.find(c => c.id === parseInt(note.category));
        const categoryName = category ? category.name : '';
        noteItem.style.background = note.color || '#fff';
        noteItem.innerHTML = `
            <div class="note-item-title">${note.title || 'Untitled'} ${note.pinned ? '<i class=\'fas fa-thumbtack\'></i>' : ''}</div>
            <div class="note-item-meta">
                <span>${categoryName}</span>
                <span>${note.amount ? '₹' + note.amount : ''}</span>
                <span>${note.date ? new Date(note.date).toLocaleDateString() : ''}</span>
                <span>${(note.tags || []).map(t => `<span class=\'tag\'>#${t}</span>`).join(' ')}</span>
                <span>${new Date(note.updatedAt).toLocaleDateString()}</span>
            </div>
            <div class="note-actions">
                <button onclick="event.stopPropagation(); toggleArchiveNote(${note.id})" class="note-action-btn archive-btn" title="${note.archived ? 'Unarchive' : 'Archive'}">
                    <i class="fas fa-archive"></i>
                </button>
                <button onclick="event.stopPropagation(); deleteNoteWithConfirmation(${note.id})" class="note-action-btn delete-btn" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        noteItem.addEventListener('click', () => loadNote(note.id));
        notesList.appendChild(noteItem);
    });
}

function saveToLocalStorage() {
    localStorage.setItem('notex_notes', JSON.stringify(notes));
    localStorage.setItem('notex_categories', JSON.stringify(categories));
}

function loadFromLocalStorage() {
    const savedNotes = localStorage.getItem('notex_notes');
    const savedCategories = localStorage.getItem('notex_categories');
    
    if (savedNotes) {
        notes = JSON.parse(savedNotes);
    }
    
    if (savedCategories) {
        categories = JSON.parse(savedCategories);
    }
}

function showNotification(message) {
    // You can implement a more sophisticated notification system here
    alert(message);
}

// Reminder logic
function saveReminder() {
    if (!currentNote) return;
    const dt = document.getElementById('reminderDateTime').value;
    if (dt) {
        currentNote.reminder = dt;
        saveNote();
        document.getElementById('reminderInfo').textContent = `Reminder: ${new Date(dt).toLocaleString()}`;
        scheduleReminder(dt, currentNote.title);
    }
    closeReminderModal();
}
function closeReminderModal() {
    document.getElementById('reminderModal').style.display = 'none';
}
function scheduleReminder(dt, title) {
    const now = new Date();
    const reminderTime = new Date(dt);
    const ms = reminderTime - now;
    if (reminderTimeout) clearTimeout(reminderTimeout);
    if (ms > 0) {
        reminderTimeout = setTimeout(() => {
            showNotification(`Reminder: ${title}`);
        }, ms);
    }
}
// Export/Import logic
function exportNotes() {
    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(notes));
    const dlAnchor = document.createElement('a');
    dlAnchor.setAttribute("href", dataStr);
    dlAnchor.setAttribute("download", "notes_export.json");
    document.body.appendChild(dlAnchor);
    dlAnchor.click();
    dlAnchor.remove();
}
function importNotes() {
    const fileInput = document.getElementById('importFileInput');
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            try {
                const imported = JSON.parse(e.target.result);
                if (Array.isArray(imported)) {
                    notes = notes.concat(imported);
                    saveToLocalStorage();
                    renderNotesList();
                    showNotification('Notes imported!');
                }
            } catch (err) {
                showNotification('Import failed: Invalid file.');
            }
        };
        reader.readAsText(fileInput.files[0]);
    }
    closeImportModal();
}
function closeImportModal() {
    document.getElementById('importModal').style.display = 'none';
}
// Template logic
function applyTemplate(type) {
    if (type === 'expense') {
        document.getElementById('noteTitle').value = 'Expense';
        document.getElementById('noteAmount').value = '';
        document.getElementById('noteContent').innerHTML = '<ul><li>Item: </li><li>Amount: </li><li>Date: </li></ul>';
    } else if (type === 'vocabulary') {
        document.getElementById('noteTitle').value = 'Vocabulary';
        document.getElementById('noteContent').innerHTML = '<ul><li>Word: </li><li>Meaning: </li><li>Example: </li></ul>';
    } else if (type === 'todo') {
        document.getElementById('noteTitle').value = 'To-Do';
        document.getElementById('noteContent').innerHTML = '<ul><li>[ ] Task 1</li><li>[ ] Task 2</li></ul>';
    }
    closeTemplateModal();
}
function closeTemplateModal() {
    document.getElementById('templateModal').style.display = 'none';
}
</script> 